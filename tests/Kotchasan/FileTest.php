<?php

namespace Kotchasan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-23 at 11:52:54.
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var File
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new File;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert ('index.php.sql') [==] 'sql'.
	 *
	 * @covers Kotchasan\File::ext
	 */
	public function testExt()
	{

		$this->assertEquals(
		'sql', \Kotchasan\File::ext('index.php.sql')
		);
	}

	/**
	 * @covers Kotchasan\File::listFiles
	 * @todo   Implement testListFiles().
	 */
	public function testListFiles()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\File::copyDirectory
	 * @todo   Implement testCopyDirectory().
	 */
	public function testCopyDirectory()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\File::makeDirectory
	 * @todo   Implement testMakeDirectory().
	 */
	public function testMakeDirectory()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\File::removeDirectory
	 * @todo   Implement testRemoveDirectory().
	 */
	public function testRemoveDirectory()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}
}