<?php

/**
 * InstallForm class.
 * InstallForm is the data structure for keeping
 * install form data.
 */
class InstallForm extends CFormModel
{
	public $password;
	public $ga_code;
	public $ga_secret;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username, password and ga_code are required
			array('password, ga_code, ga_secret', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password' => 'Password',
			'ga_code' => 'Google Authenticator Code'
		);
	}

}
