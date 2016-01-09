<?php
/**
 * @filesource index/controllers/forgot.php
 * @link http://www.kotchasan.com/
 * @copyright 2015 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Index\Forgot;

use \Login as Login;

/**
 * Forgot Form
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Controller
{

	/**
	 * แสดงผล
	 */
	public function render()
	{
		// แสดงผล
		$form = \Html::create('form', array(
			'id' => 'forgot_frm',
			'class' => 'login',
			'autocomplete' => 'off',
			'ajax' => false
		));
		// h1
		$form->add('h1', array(
			'class' => 'icon-password',
			'innerHTML' => \Language::get('Request new password')
		));
		// message
		if (!empty(Login::$login_message)) {
			$form->add('p', array(
				'class' => empty(Login::$login_input) ? 'message' : 'error',
				'innerHTML' => Login::$login_message
			));
		}
		// fieldset
		$fieldset = $form->add('fieldset');
		// email
		$fieldset->add('email', array(
			'id' => 'email_email',
			'labelClass' => 'g-input icon-email',
			'placeholder' => \Language::get('Email'),
			'value' => isset(Login::$text_email) ? Login::$text_email : '',
			'autofocus',
			'required',
			'accesskey' => 'e',
			'maxlength' => 255,
			'comment' => \Language::get('New password will be sent to the email address registered. If you do not remember or do not receive emails. Please contact your system administrator (Please check in the Junk Box)')
		));
		// input-groups (div สำหรับจัดกลุ่ม input)
		$group = $fieldset->add('groups');
		// a
		$group->add('a', array(
			'href' => \Url::next(array('action' => 'login')),
			'class' => 'td',
			'title' => \Language::get('Administrator area'),
			'innerHTML' => ''.\Language::get('Sign In').' ?'
		));
		// submit
		$fieldset->add('submit', array(
			'class' => 'button ok large wide',
			'value' => \Language::get('Get new password')
		));
		$fieldset->add('hidden', array(
			'id' => 'action',
			'value' => 'forgot'
		));
		return $form->render();
	}

	/**
	 * title bar
	 */
	public function title()
	{
		return \Language::get('Request new password');
	}
}