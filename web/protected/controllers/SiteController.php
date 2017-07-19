<?php

class SiteController extends Controller
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
	    			'actions'=>array('index', 'login', 'error'),
	    			'users'=>array('*'),
	    		),
	    		array('allow',
	   				'actions'=>array('logout'),
	 				'users'=>array('@'),
	   			),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->pageTitle = 'Welcome';
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout='//layouts/login';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/login';
		$this->pageTitle = 'Login';

		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				if (Yii::app()->user->returnUrl == '')
					Yii::app()->user->returnUrl = Yii::app()->request->baseUrl . '/';

				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
