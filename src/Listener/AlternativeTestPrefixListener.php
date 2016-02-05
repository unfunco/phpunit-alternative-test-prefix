<?php

namespace Unfunco\PHPUnit\Listener;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_TestSuite;
use PHPUnit_Framework_TestSuite_DataProvider;
use PHPUnit_Util_Test;
use ReflectionClass;
use ReflectionMethod;

/**
 * Alternative test prefix listener.
 *
 * @package Unfunco\PHPUnit
 * @author  Daniel Morris <daniel@honestempire.com>
 */
class AlternativeTestPrefixListener implements \PHPUnit_Framework_TestListener
{
    /**
     * The regular expression used to check for configured test prefixes.
     *
     * @var string
     */
    protected $prefixRegExp;

    /**
     * The prefixes specified within the PHPUnit configuration file.
     *
     * @var array
     */
    private $prefixes;

    /**
     * Instantiates a new instance of the alternative test prefix listener.
     *
     * @param array $prefixes Prefixes specified within the PHPUnit configuration file.
     */
    public function __construct(array $prefixes)
    {
        $this->prefixes = $prefixes;
        $this->prefixRegExp = sprintf('/^%s/', implode('|', $prefixes));
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_TestSuite $suite The test suite.
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        /** @var PHPUnit_Framework_TestSuite $test */
        foreach ($suite->tests() as $test) {
            $testClass = $test->getName();

            if (!class_exists($testClass)) {
                continue;
            }

            $reflectedClass = new ReflectionClass($testClass);
            $reflectedClassMethods = $reflectedClass->getMethods(ReflectionMethod::IS_PUBLIC);

            foreach ($reflectedClassMethods as $reflectedClassMethod) {
                $reflectedClassMethodName = $reflectedClassMethod->getName();

                if (1 === preg_match($this->prefixRegExp, $reflectedClassMethodName)) {
                    $this->addTestToSuite($suite, $reflectedClass, $reflectedClassMethodName);
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     * @param Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test                 $test The test.
     * @param PHPUnit_Framework_AssertionFailedError $e    The error.
     * @param float                                   $time The time.
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     * @param Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     * @param Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     * @param Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_TestSuite $suite The test suite.
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param PHPUnit_Framework_Test $test The test.
     * @param float                   $time The time.
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
    }

    /**
     * Adds a test to the test suite.
     *
     * @param PHPUnit_Framework_TestSuite $suite          The test suite.
     * @param ReflectionClass             $reflectedClass The reflected class.
     * @param string                      $methodName     The name of the test method within the reflected class.
     *
     * @return void
     */
    protected function addTestToSuite(PHPUnit_Framework_TestSuite $suite, ReflectionClass $reflectedClass, $methodName)
    {
        $test = $suite->createTest($reflectedClass, $methodName);

        if ($test instanceof PHPUnit_Framework_TestCase || $test instanceof PHPUnit_Framework_TestSuite_DataProvider) {
            $test->setDependencies(PHPUnit_Util_Test::getDependencies($reflectedClass->getName(), $methodName));
        }

        $suite->addTest($test, PHPUnit_Util_Test::getGroups($reflectedClass->getName(), $methodName));
    }
}
