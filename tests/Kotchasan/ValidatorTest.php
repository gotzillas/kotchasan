<?php

namespace Kotchasan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-03-30 at 16:18:40.
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Validator
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new Validator();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert ('admin@localhost.com') [==] true.
	 *
	 * @covers Kotchasan\Validator::email
	 */
	public function testEmail()
	{

		$this->assertTrue(
			\Kotchasan\Validator::email('admin@localhost.com')
		);
	}

	/**
	 * Generated from @assert ('admin@localhost') [==] true.
	 *
	 * @covers Kotchasan\Validator::email
	 */
	public function testEmail2()
	{

		$this->assertTrue(
			\Kotchasan\Validator::email('admin@localhost')
		);
	}

	/**
	 * Generated from @assert ('ทดสอบ@localhost') [==] false.
	 *
	 * @covers Kotchasan\Validator::email
	 */
	public function testEmail3()
	{

		$this->assertFalse(
			\Kotchasan\Validator::email('ทดสอบ@localhost')
		);
	}

	/**
	 * Generated from @assert ('admin@ไทย') [==] true.
	 *
	 * @covers Kotchasan\Validator::email
	 */
	public function testEmail4()
	{

		$this->assertTrue(
			\Kotchasan\Validator::email('admin@ไทย')
		);
	}

	/**
	 * Generated from @assert ('0123456789016') [==] true.
	 *
	 * @covers Kotchasan\Validator::idCard
	 */
	public function testIdCard()
	{

		$this->assertTrue(
			\Kotchasan\Validator::idCard('0123456789016')
		);
	}

	/**
	 * Generated from @assert ('0123456789015') [==] false.
	 *
	 * @covers Kotchasan\Validator::idCard
	 */
	public function testIdCard2()
	{

		$this->assertFalse(
			\Kotchasan\Validator::idCard('0123456789015')
		);
	}

	/**
	 * @covers Kotchasan\Validator::isImage
	 * @todo   Implement testIsImage().
	 */
	public function testIsImage()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}