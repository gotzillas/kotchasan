<?php

namespace Kotchasan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-23 at 11:18:14.
 */
class UrlTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Url
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new Url;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert (array('module' => 'mymodule', 'id' => 1)) [==] "?_module=test&amp;_page=1&amp;_sort=id&amp;module=mymodule&amp;id=1" [[$_GET = array('module' => 'test', 'page' => 1, 'sort' => 'id')]].
	 *
	 * @covers Kotchasan\Url::replace
	 */
	public function testReplace()
	{
		$_GET = array('module' => 'test', 'page' => 1, 'sort' => 'id');
		$this->assertEquals(
		"?_module=test&amp;_page=1&amp;_sort=id&amp;module=mymodule&amp;id=1", \Kotchasan\Url::replace(array('module' => 'mymodule', 'id' => 1))
		);
	}

	/**
	 * Generated from @assert (array(2 => 'module=retmodule')) [==] "?module=retmodule&amp;page=1&amp;sort=id"  [[$_GET = array('_module' => 'test', '_page' => 1, '_sort' => 'id')]].
	 *
	 * @covers Kotchasan\Url::back
	 */
	public function testBack()
	{
		$_GET = array('_module' => 'test', '_page' => 1, '_sort' => 'id');
		$this->assertEquals(
		"?module=retmodule&amp;page=1&amp;sort=id", \Kotchasan\Url::back(array(2 => 'module=retmodule'))
		);
	}

	/**
	 * Generated from @assert ('module=retmodule') [==] "?module=retmodule&amp;page=1&amp;sort=id" [[$_GET = array('_module' => 'test', '_page' => 1, '_sort' => 'id')]].
	 *
	 * @covers Kotchasan\Url::back
	 */
	public function testBack2()
	{
		$_GET = array('_module' => 'test', '_page' => 1, '_sort' => 'id');
		$this->assertEquals(
		"?module=retmodule&amp;page=1&amp;sort=id", \Kotchasan\Url::back('module=retmodule')
		);
	}

	/**
	 * Generated from @assert ('index.php', array('id'=>1)) [==] "index.php?id=1&module=test&page=1&sort=id"  [[$_POST = array('_module' => 'test', '_page' => 1, '_sort' => 'id')]].
	 *
	 * @covers Kotchasan\Url::postBack
	 */
	public function testPostBack()
	{
		$_POST = array('_module' => 'test', '_page' => 1, '_sort' => 'id');
		$this->assertEquals(
		"index.php?id=1&module=test&page=1&sort=id", \Kotchasan\Url::postBack('index.php', array('id' => 1))
		);
	}

	/**
	 * Generated from @assert ('index.php', array('page'=>2, 'module'=>'mymodule')) [==] "index.php?page=2&module=mymodule&sort=id"  [[$_POST = array('_module' => 'test', '_page' => 1, '_sort' => 'id')]].
	 *
	 * @covers Kotchasan\Url::postBack
	 */
	public function testPostBack2()
	{
		$_POST = array('_module' => 'test', '_page' => 1, '_sort' => 'id');
		$this->assertEquals(
		"index.php?page=2&module=mymodule&sort=id", \Kotchasan\Url::postBack('index.php', array('page' => 2, 'module' => 'mymodule'))
		);
	}

	/**
	 * Generated from @assert (array('action'=> 'one', 'visited')) [==] "?action=one&amp;visited".
	 *
	 * @covers Kotchasan\Url::next
	 */
	public function testNext()
	{

		$this->assertEquals(
		"?action=one&amp;visited", \Kotchasan\Url::next(array('action' => 'one', 'visited'))
		);
	}

	/**
	 * @covers Kotchasan\Url::pagination
	 * @todo   Implement testPagination().
	 */
	public function testPagination()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		'This test has not been implemented yet.'
		);
	}
}