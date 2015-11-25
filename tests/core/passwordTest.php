<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-18 at 22:18:05.
 */
class PasswordTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var Password
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new Password;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert (\Password::encode("1234")) [==] "1234".
	 *
	 * @covers Password::decode
	 */
	public function testDecode()
	{

		$this->assertEquals(
		"1234", \Password::decode(\Password::encode("1234"))
		);
	}

	/**
	 * Generated from @assert (\Password::encode(1234)) [==] 1234.
	 *
	 * @covers Password::decode
	 */
	public function testDecode2()
	{

		$this->assertEquals(
		1234, \Password::decode(\Password::encode(1234))
		);
	}

	/**
	 * @covers Password::encode
	 * @todo   Implement testEncode().
	 */
	public function testEncode()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}
}