<?php

namespace Unfunco\PHPUnit\Listener;

/**
 * Alternative test prefix listener.
 *
 * @package Unfunco\PHPUnit\Listener
 * @author  Daniel Morris <daniel@honestempire.com>
 */
class AlternativeTestPrefixListener implements \PHPUnit_Framework_TestListener
{
    /**
     * Array of prefixes.
     *
     * @var array
     */
    private $prefixes;

    /**
     * Constructor.
     *
     * @param array $prefixes Prefixes specified within the PHPUnit configuration file.
     */
    public function __construct(array $prefixes)
    {
        $this->prefixes = $prefixes;
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_TestSuite $suite
     */
    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
        $prefixPattern = sprintf('/^%s/', implode('|', $this->prefixes));

        /** @var \PHPUnit_Framework_TestSuite $test */
        foreach ($suite->tests() as $test) {
            $testClass = $test->getName();

            if (!class_exists($testClass)) {
                continue;
            }

            $reflectedClass = new \ReflectionClass($testClass);
            $methods = $reflectedClass->getMethods(\ReflectionMethod::IS_PUBLIC);

            foreach ($methods as $method) {
                $methodName = $method->getName();

                if (0 === preg_match($prefixPattern, $methodName)) {
                    continue;
                }

                $test = $suite->createTest($reflectedClass, $methodName);

                if ($test instanceof \PHPUnit_Framework_TestCase ||
                    $test instanceof \PHPUnit_Framework_TestSuite_DataProvider) {
                    /** @var \PHPUnit_Framework_TestCase|\PHPUnit_Framework_TestSuite_DataProvider $test */
                    $test->setDependencies(
                        \PHPUnit_Util_Test::getDependencies($reflectedClass->getName(), $methodName)
                    );
                }

                $suite->addTest(
                    $test,
                    \PHPUnit_Util_Test::getGroups($reflectedClass->getName(), $methodName)
                );
            }
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     * @param \Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addError(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test                 $test The test.
     * @param \PHPUnit_Framework_AssertionFailedError $e    The error.
     * @param float                                   $time The time.
     */
    public function addFailure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     * @param \Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addIncompleteTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     * @param \Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addRiskyTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     * @param \Exception              $e    The exception.
     * @param float                   $time The time.
     */
    public function addSkippedTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_TestSuite $suite The test suite.
     */
    public function endTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     */
    public function startTest(\PHPUnit_Framework_Test $test)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @param \PHPUnit_Framework_Test $test The test.
     * @param float                   $time The time.
     */
    public function endTest(\PHPUnit_Framework_Test $test, $time)
    {
    }
}
