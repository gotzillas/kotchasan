<?php
/*
 * @filesource Kotchasan/Login.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Kotchasan;

use \Kotchasan\LoginInterface;
use \Kotchasan\Password;
use \Kotchasan\Language;
use \Kotchasan\Http\Request;

/**
 * คลาสสำหรับตรวจสอบการ Login
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Login extends \Kotchasan\KBase implements LoginInterface
{
	/**
	 * ข้อความจาก Login Class
	 *
	 * @var string
	 */
	public static $login_message;
	/**
	 * ชื่อ Input ที่ต้องการให้ active
	 * login_email หรือ login_password
	 *
	 * @var string
	 */
	public static $login_input;
	/**
	 * ข้อความใน Input login_email
	 *
	 * @var string
	 */
	public static $text_email;
	/**
	 * ข้อความใน Input login_password
	 *
	 * @var string
	 */
	public static $text_password;

	/**
	 * ตรวจสอบการ login เมื่อมีการเรียกใช้ class new Login
	 * action=logout ออกจากระบบ
	 * มาจากการ submit ตรวจสอบการ login
	 * ถ้าไม่มีทั้งสองส่วนด้านบน จะตรวจสอบการ login จาก session และ cookie ตามลำดับ
	 *
	 * @return \static
	 */
	public static function create()
	{
		// create class
		$login = new static;
		// การเข้ารหัส
		$pw = new Password(self::$cfg->password_key);
		// ค่าที่ส่งมา
		self::$text_email = $login->get('login_email', $pw);
		self::$text_password = $login->get('login_password', $pw);
		$login_remember = $login->get('login_remember', $pw) == 1 ? 1 : 0;
		$action = self::$request->request('action')->toString();
		// ตรวจสอบการ login
		if ($action === 'EMAIL_EXISIS') {
			// error มี email อยู่แล้ว (facebook login)
			self::$login_message = str_replace(':name', Language::get('Email'), Language::get('This :name is already registered'));
		} elseif ($action === 'logout' && self::$request->post('login_email')->toString() == '') {
			// logout ลบ session และ cookie
			self::$request->setSession('klogin', null);
			$time = time();
			setCookie('login_email', '', $time, '/');
			setCookie('login_password', '', $time, '/');
			self::$login_message = Language::get('Logout successful');
		} elseif ($action === 'forgot') {
			// ลืมรหัสผ่าน
			return $login->forgot();
		} else {
			// ตรวจสอบค่าที่ส่งมา
			if (self::$text_email != '' && self::$text_password != '') {
				// ตรวจสอบการกรอก
				if (self::$text_email == '') {
					self::$login_message = Language::get('Please fill out this form');
					self::$login_input = 'login_email';
				} elseif (self::$text_password == '') {
					self::$login_message = Language::get('Please fill out this form');
					self::$login_input = 'login_password';
				} else {
					// ตรวจสอบการ login กับฐานข้อมูล
					$login_result = $login->checkLogin(self::$text_email, self::$text_password);
					if (is_string($login_result)) {
						// ข้อความผิดพลาด
						self::$login_input = $login_result == 'Incorrect password' ? 'login_password' : 'login_email';
						self::$login_message = Language::get($login_result);
					} else {
						// save login session
						$login_result->password = self::$text_password;
						self::$request->setSession('klogin', $login_result);
						// save login cookie
						$time = time() + 2592000;
						if ($login_remember == 1) {
							setcookie('login_email', $pw->encode(self::$text_email), $time, '/');
							setcookie('login_password', $pw->encode(self::$text_password), $time, '/');
							setcookie('login_remember', $login_remember, $time, '/');
						}
						setcookie('login_id', $login_result->id, $time, '/');
					}
				}
			} elseif (self::$text_email !== null) {
				self::$login_message = Language::get('Please fill out this form');
				self::$login_input = 'login_email';
			}
			return $login;
		}
	}

	/**
	 * อ่านข้อมูลจาก POST, SESSION และ COOKIE ตามลำดับ
	 * เจออันไหนก่อนใช้อันนั้น
	 *
	 * @param string $name
	 * @param Password $pwd
	 * @return string|null คืนค่าข้อความ ไม่พบคืนค่า null
	 */
	protected function get($name, Password $pwd)
	{
		$datas = self::$request->getParsedBody();
		if (isset($datas[$name])) {
			return (string)$datas[$name];
		} elseif ($datas = self::$request->session($name)->toString()) {
			return (string)$datas;
		}
		$datas = self::$request->getCookieParams();
		return isset($datas[$name]) ? $pwd->decode($datas[$name]) : null;
	}

	/**
	 * ฟังก์ชั่นตรวจสอบการ login
	 *
	 * @param string $username
	 * @param string $password
	 * @return string|object เข้าระบบสำเร็จคืนค่า Object ข้อมูลสมาชิก, ไม่สำเร็จ คืนค่าข้อความผิดพลาด
	 */
	public function checkLogin($username, $password)
	{
		if ($username == self::$cfg->get('username') && $password == self::$cfg->get('password')) {
			return (object)array(
					'id' => 1,
					'email' => $username,
					'password' => $password,
					'displayname' => $username,
					'status' => 1
			);
		}
		return 'not a registered user';
	}

	/**
	 * ฟังก์ชั่นส่งอีเมล์ลืมรหัสผ่าน
	 */
	public function forgot()
	{
		return $this;
	}

	/**
	 * ฟังก์ชั่นตรวจสอบการเข้าระบบ
	 *
	 * @return object|null คืนค่าข้อมูลสมาชิก (object) ถ้าเป็นสมาชิกและเข้าระบบแล้ว ไม่ใช่คืนค่า null
	 */
	public static function isMember()
	{
		return self::$request->session('klogin', null)->toObject();
	}

	/**
	 * ฟังก์ชั่นตรวจสอบสถานะแอดมิน
	 *
	 * @return object|null คืนค่าข้อมูลสมาชิก (object) ถ้าเป็นผู้ดูแลระบบและเข้าระบบแล้ว ไม่ใช่คืนค่า null
	 */
	public static function isAdmin()
	{
		$login = self::isMember();
		return isset($login->status) && $login->status == 1 ? $login : null;
	}
}