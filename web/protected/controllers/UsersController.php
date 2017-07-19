<?php

require_once(getcwd() . '/protected/vendor/PHPGangsta_GoogleAuthenticator.php');

class UsersController extends Controller
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
	   				'actions'=>array('account'),
	 				'users'=>array('@'),
	   			),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	/**
	 * Edit your account
	 */
	public function actionAccount()
	{
		$model = Users::model()->findByPk(Yii::app()->user->id);
		if ($model == '')
		{
			throw new CHttpException(404, 'User not found');
		}

		if (isset($_POST['Users']))
		{
			$model->setScenario('update');
			$model->attributes = $_POST['Users'];
			// Only update the password when it's set

			if (!empty($_POST['Users']['password']))
			{
				$model->password = GeneralHelper::hashPassword($_POST['Users']['password']);
			}
			else
			{
				unset($model->password);
			}

			if ($model->save())
			{
				Yii::app()->user->setFlash('ok', 'Details updated');
				$this->redirect(array('manage/index'));
			}
		}

		$ga = new PHPGangsta_GoogleAuthenticator();
		$qr_url = $ga->getQRCodeGoogleUrl('Unattended Server', $model->ga_secret);

		$model->password = '';
		$this->render('account', array(
			'model' => $model,
			'qr_url' => $qr_url
		));
	}
}
