<?php
/**
 * Copyright 2015 Klarna AB
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * File containing the PHPUnit Klarna_HTTP_RequestTest test case
 *
 * PHP version 5.2
 *
 * @category   Payment
 * @package    Payment_Klarna
 * @subpackage Unit_Tests
 * @author     David K. <david.keijser@klarna.com>
 * @copyright  2015 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache license v2.0
 * @link       http://developers.klarna.com/
 */

/**
 * PHPUnit test case for the CURL Header parser
 *
 * @category   Payment
 * @package    Payment_Klarna
 * @subpackage Unit_Tests
 * @author     David K. <david.keijser@klarna.com>
 * @copyright  2015 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache license v2.0
 * @link       http://developers.klarna.com/
 */
class Klarna_Checkout_HTTP_CURLHeadersTest extends PHPUnit_Framework_TestCase
{
    /**
     * Object to test.
     *
     * @var Klarna_Checkout_HTTP_CURLHeaders
     */
    protected $parser;

    /**
     * Set up resources used for each test.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->parser = new Klarna_Checkout_HTTP_CURLHeaders;
    }

    /**
     * Test that the process method produces the correct headers
     *
     * @return void
     */
    public function testProcess()
    {
        $headers = array("Accept: Anything", "Foo-Bar: Test");
        foreach ($headers as $header) {
            $used = $this->parser->processHeader(null, $header);
            $this->assertEquals(strlen($header), $used);
        }
        $this->assertEquals(2, count($this->parser->getHeaders()));
    }

    /**
     * Test that process yields nothing from invalid headers
     *
     * @return void
     */
    public function testProcessInvalid()
    {
        $headers = array("Accept; Anything", "Foo-Bar Test");
        foreach ($headers as $header) {
            $used = $this->parser->processHeader(null, $header);
            $this->assertEquals(strlen($header), $used);
        }
        $expected = array();
        $this->assertEquals($expected, $this->parser->getHeaders());
    }
}
