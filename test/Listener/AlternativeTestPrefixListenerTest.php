<?php

/*
 * PHPUnit alternative test prefix listener
 *
 * Copyright © 2016 Daniel Morris <daniel@honestempire.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace Unfunco\PHPUnit\Test\Listener;

use PHPUnit_Framework_TestCase;

/**
 * Basic test of the alternative test prefix listener.
 *
 * @package Unfunco\PHPUnit\Test
 * @author  Daniel Morris <daniel@honestempire.com>
 */
class AlternativeTestPrefixListenerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests the default test method prefix.
     *
     * @return void
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
    public function itDoesDivision()
    {
        $this->assertEquals(25, 100 / 4);
    }

    /**
     * Tests that annotations are still working.
     *
     * @test
     *
     * @return void
     */
    public function annotatedTest()
    {
        $this->assertEquals(5318008, 1329502 * 4);
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
