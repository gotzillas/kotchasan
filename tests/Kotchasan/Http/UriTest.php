<?php

namespace Kotchasan\Http;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-19 at 14:15:04.
 */
class UriTest extends \PHPUnit_Framework_TestCase
{

	public function uriFactory()
	{
		$scheme = 'https';
		$host = 'example.com';
		$port = 443;
		$path = '/foo/bar';
		$query = 'abc=123';
		$fragment = 'fragment';
		$user = 'admin';
		$pass = '1234';
		return new Uri($scheme, $host, $path, $query, $port, $user, $pass, $fragment);
	}
	/*	 * ******************************************************************************
	 * Scheme
	 * ***************************************************************************** */

	public function testGetScheme()
	{
		$this->assertEquals('https', $this->uriFactory()->getScheme());
	}

	public function testWithScheme()
	{
		$uri = $this->uriFactory()->withScheme('http');
		$this->assertAttributeEquals('http', 'scheme', $uri);
	}

	public function testWithSchemeRemovesSuffix()
	{
		$uri = $this->uriFactory()->withScheme('http://');
		$this->assertAttributeEquals('http', 'scheme', $uri);
	}

	public function testWithSchemeEmpty()
	{
		$uri = $this->uriFactory()->withScheme('');
		$this->assertAttributeEquals('', 'scheme', $uri);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testWithSchemeInvalid()
	{
		$this->uriFactory()->withScheme('ftp');
	}
	/*	 * ******************************************************************************
	 * Authority
	 * ***************************************************************************** */

	public function testGetAuthorityWithUsernameAndPassword()
	{
		$this->assertEquals('admin:1234@example.com', $this->uriFactory()->getAuthority());
	}

	public function testGetUserInfo()
	{
		$this->assertEquals('admin:1234', $this->uriFactory()->getUserInfo());
	}

	public function testGetPort()
	{
		$this->assertEquals(null, $this->uriFactory()->getPort());
	}

	public function testWithUserInfo()
	{
		$uri = $this->uriFactory()->withUserInfo('newuser', 'pass');
		$this->assertAttributeEquals('newuser:pass', 'userInfo', $uri);
	}

	public function testWithUserInfoRemovesPassword()
	{
		$uri = $this->uriFactory()->withUserInfo('newuser', '');
		$this->assertAttributeEquals('newuser', 'userInfo', $uri);
	}

	public function testGetHost()
	{
		$this->assertEquals('example.com', $this->uriFactory()->getHost());
	}

	public function testWithHost()
	{
		$uri = $this->uriFactory()->withHost('demo.com');
		$this->assertAttributeEquals('demo.com', 'host', $uri);
	}

	public function testGetPortWithSchemeAndNonDefaultPort()
	{
		$uri = new Uri('https', 'www.example.com', '/', '', 4000);
		$this->assertEquals(4000, $uri->getPort());
	}

	public function testGetPortWithSchemeAndDefaultPort()
	{
		$uriHppt = new Uri('http', 'www.example.com', '/', '', 80);
		$uriHppts = new Uri('https', 'www.example.com', '/', '', 443);
		$this->assertNull($uriHppt->getPort());
		$this->assertNull($uriHppts->getPort());
	}

	public function testGetPortWithoutSchemeAndPort()
	{
		$uri = new Uri('', 'www.example.com');
		$this->assertNull($uri->getPort());
	}

	public function testGetPortWithSchemeWithoutPort()
	{
		$uri = new Uri('http', 'www.example.com');
		$this->assertNull($uri->getPort());
	}

	public function testWithPort()
	{
		$uri = $this->uriFactory()->withPort(8000);
		$this->assertAttributeEquals(8000, 'port', $uri);
	}

	public function testWithPortNull()
	{
		$uri = $this->uriFactory()->withPort(null);
		$this->assertAttributeEquals(null, 'port', $uri);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testWithPortInvalidInt()
	{
		$this->uriFactory()->withPort(70000);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testWithPortInvalidString()
	{
		$this->uriFactory()->withPort('Foo');
	}
	/*	 * ******************************************************************************
	 * Path
	 * ***************************************************************************** */

	public function testGetPath()
	{
		$this->assertEquals('/foo/bar', $this->uriFactory()->getPath());
	}

	public function testWithPath()
	{
		$uri = $this->uriFactory()->withPath('/new');
		$this->assertAttributeEquals('/new', 'path', $uri);
	}

	public function testWithPathWithoutPrefix()
	{
		$uri = $this->uriFactory()->withPath('new');
		$this->assertAttributeEquals('new', 'path', $uri);
	}

	public function testWithPathEmptyValue()
	{
		$uri = $this->uriFactory()->withPath('');
		$this->assertAttributeEquals('', 'path', $uri);
	}

	public function testWithPathUrlEncodesInput()
	{
		$uri = $this->uriFactory()->withPath('/includes?/new');
		$this->assertAttributeEquals('/includes%3F/new', 'path', $uri);
	}

	public function testWithPathDoesNotDoubleEncodeInput()
	{
		$uri = $this->uriFactory()->withPath('/include%25s/new');
		$this->assertAttributeEquals('/include%25s/new', 'path', $uri);
	}
	/*	 * ******************************************************************************
	 * Query
	 * ***************************************************************************** */

	public function testGetQuery()
	{
		$this->assertEquals('abc=123', $this->uriFactory()->getQuery());
	}

	public function testWithQuery()
	{
		$uri = $this->uriFactory()->withQuery('xyz=123');
		$this->assertAttributeEquals('xyz=123', 'query', $uri);
	}

	public function testWithQueryRemovesPrefix()
	{
		$uri = $this->uriFactory()->withQuery('?xyz=123');
		$this->assertAttributeEquals('xyz=123', 'query', $uri);
	}

	public function testWithQueryEmpty()
	{
		$uri = $this->uriFactory()->withQuery('');
		$this->assertAttributeEquals('', 'query', $uri);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testWithQueryInvalidType()
	{
		$this->uriFactory()->withQuery(['foo']);
	}
	/*	 * ******************************************************************************
	 * Fragment
	 * ***************************************************************************** */

	public function testGetFragment()
	{
		$this->assertEquals('fragment', $this->uriFactory()->getFragment());
	}

	public function testWithFragment()
	{
		$uri = $this->uriFactory()->withFragment('other-fragment');
		$this->assertAttributeEquals('other-fragment', 'fragment', $uri);
	}

	public function testWithFragmentRemovesPrefix()
	{
		$uri = $this->uriFactory()->withFragment('#other-fragment');
		$this->assertAttributeEquals('other-fragment', 'fragment', $uri);
	}

	public function testWithFragmentEmpty()
	{
		$uri = $this->uriFactory()->withFragment('');
		$this->assertAttributeEquals('', 'fragment', $uri);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testWithFragmentInvalidType()
	{
		$this->uriFactory()->withFragment(array('foo'));
	}
	/*	 * ******************************************************************************
	 * Helpers
	 * ***************************************************************************** */

	public function testToString()
	{
		$uri = $this->uriFactory();
		$this->assertEquals('https://admin:1234@example.com/foo/bar?abc=123#fragment', (string)$uri);
		$uri = $uri->withPath('bar');
		$this->assertEquals('https://admin:1234@example.com/bar?abc=123#fragment', (string)$uri);
		$_SERVER = array(
			'SCRIPT_NAME' => '/foo/index.php',
			'REQUEST_URI' => '/foo/',
			'HTTP_HOST' => 'example.com',
		);
		$uri = Uri::createFromGlobals();
		$this->assertEquals('http://example.com/foo/', (string)$uri);
	}

	public function testCreateFromString()
	{
		$uri = Uri::createFromUri('https://example.com:8080/foo/bar?abc=123');
		$this->assertEquals('https', $uri->getScheme());
		$this->assertEquals('example.com', $uri->getHost());
		$this->assertEquals('8080', $uri->getPort());
		$this->assertEquals('/foo/bar', $uri->getPath());
		$this->assertEquals('abc=123', $uri->getQuery());
	}

	public function testParseQueryParams()
	{
		$this->assertEquals(
		array('module' => 'home', 'id' => 1, 0 => 'visited'), $this->uriFactory()->parseQueryParams('module=home&id=1&visited')
		);
	}

	public function testParamsToQuery()
	{
		$this->assertEquals(
		'module=home&amp;id=1&amp;visited', $this->uriFactory()->paramsToQuery(array('module' => 'home', 'id' => 1, 0 => 'visited'), true)
		);
	}

	public function testParamsToQuery2()
	{
		$this->assertEquals(
		'module=home&id=1&visited', $this->uriFactory()->paramsToQuery(array('module' => 'home', 'id' => 1, 0 => 'visited'), false)
		);
	}

	public function testPostBack()
	{
		$_POST = array('_module' => 'test', '_page' => 1, '_sort' => 'id');
		$this->assertEquals(
		"index.php?page=2&module=mymodule&sort=id", $this->uriFactory()->postBack('index.php', array('page' => 2, 'module' => 'mymodule', 'time' => null))
		);
	}

	public function testCreateBackUri()
	{
		$uri = $this->uriFactory()->createBackUri(array(
			'module' => 'test',
			'abc' => null
		));
		$this->assertEquals('https://admin:1234@example.com/foo/bar?module=test#fragment', (string)$uri);
	}
}