<?php

require_once(getcwd() . '/protected/vendor/PHPGangsta_GoogleAuthenticator.php');

class InstallController extends Controller
{
	public function filters()
    {
        return array(
            'accessControl',
        	'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
		return array(
				array('allow',
	    			'actions'=>array('install'),
	    			'users'=>array('*'),
	    		),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	public function init()
	{
		$this->layout = '//layouts/install';
		parent::init();
	}

	/**
	 * Runs the guided installed
	 */
	public function actionInstall($step = 0)
	{
		$user = Users::model()->findByPk(1);
		if ($user == '')
		{
			throw new CHttpException(500, 'The admin user must have an ID of 1');
		}

		if ($user->ga_secret != '')
		{
			throw new CHttpException(400, "We're done here");
		}


		$this->pageTitle = 'Welcome to the Installer';

		$model = new InstallForm();
		$ga = new PHPGangsta_GoogleAuthenticator();
		$model->ga_secret = $ga->createSecret();
		$ga_qrurl = $ga->getQRCodeGoogleUrl('Unattended Server', $model->ga_secret);

		if (isset($_POST['InstallForm']))
		{
			$model->attributes = $_POST['InstallForm'];
			$ga_qrurl = $ga->getQRCodeGoogleUrl('Unattended Server', $model->ga_secret);

			if ($model->validate())
			{
				$user->password = GeneralHelper::hashPassword($model->password);

				$checkResult = $ga->verifyCode($model->ga_secret, $model->ga_code, 2);    // 2 = 2*30sec clock tolerance
				if ($checkResult === true)
				{
					$user->ga_secret = $model->ga_secret;
					if ($user->save())
					{
						Yii::app()->user->setFlash('ok', 'Installation Complete. You may log in');
						$this->redirect('site/login');
					}
				}
				else
				{
					$model->addError('ga_secret', 'Incorrect Authenticator Code entered');
				}
			}
		}

		$this->render('install', array(
			'model' => $model,
			'qr' => $ga_qrurl
		));
	}

}
