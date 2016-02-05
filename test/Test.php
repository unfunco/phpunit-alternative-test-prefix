<?php

namespace Unfunco\PHPUnit\Test;

/**
 * Basic test of the prefix listener.
 *
 * @package Unfunco\PHPUnit\Test
 * @author  Daniel Morris <daniel@honestempire.com>
 */
class Test extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the default test method prefix.
     */
    public function testAddition()
    {
        $this->assertEquals(2, 1 + 1);
    }

    /**
     * Tests a custom test method prefix.
     *
     * @return void
     */
    public function itCanDoSubtraction()
    {
        $this->assertEquals(10, 20 - 10);
    }

    /**
     * Tests another custom test method prefix.
     *
     * @return void
     */
    public function itDoesMultiplication()
    {
        $this->assertEquals(25, 100 / 4);
    }

    /**
     * This method should not be called.
     *
     * @return void
     */
    public function itShouldNotCallThisMethod()
    {
        $this->fail('Test method executed with unregistered prefix.');
    }
}
