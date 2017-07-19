<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $user;
	public $google_code;
	const ERROR_INVALID_CREDENTIALS = 98;
	const ERROR_ACCOUNT_DEACTIVATED = 99;
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
	    $model = Users::model()->find('email = :email', array(':email' => $this->username));

		if ($model == '')
		{
			$this->errorCode = self::ERROR_INVALID_CREDENTIALS;
		}
		else
		{
			$ga = new PHPGangsta_GoogleAuthenticator();
			if ($model->ga_secret != '')
			{
				$secret = $model->ga_secret;
				$ga_passed = $ga->verifyCode($secret, $this->google_code);
			}
			else
			{
				// If no secret, not enabled
				$ga_passed = true;
			}

			//$name   = 'Unattended Server';
	        //$url = $ga->getQRCodeGoogleUrl($name, $secret);

			if ($ga_passed == false)
			{
				$this->errorCode = self::ERROR_INVALID_CREDENTIALS;
			}
			else
			{
				if (password_verify($this->password, $model->password))
				{
					$this->setUser($model);
					$this->errorCode = self::ERROR_NONE;
				}
				else
				{
					$this->errorCode = self::ERROR_INVALID_CREDENTIALS;
				}
			}
		}
		return !$this->errorCode;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($userdata)
	{
		$this->user = $userdata;
	}
}
