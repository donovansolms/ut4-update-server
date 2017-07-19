<?php

class ManageController extends Controller
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
	   				'actions'=>array('index', 'create', 'delete'),
	 				'users'=>array('@'),
	   			),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	/**
	 * List the available updates
	 */
	public function actionIndex()
	{
		$model = new Updates('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Updates'])) {
			$model->attributes = $_GET['Updates'];
		}

		$this->pageTitle = 'Welcome';
		$this->render('index', array(
			'model' => $model
		));
	}

	/**
	 * Create a new update
	 */
	public function actionCreate()
	{
		$model = new Updates('create');

		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['Updates']))
			{
				$model->attributes = $_POST['Updates'];
				$model->date_created = new CDbExpression('NOW()');

				$version = $_POST['Updates_major'] . '.' . $_POST['Updates_minor'] . '.';
				$version .= $_POST['Updates_patch'] . '.' . $_POST['Updates_build'];
				$model->version = $version;

				if ($model->save())
				{
					Yii::app()->user->setFlash('ok', 'Update published');
					$this->redirect(array('manage/index'));
				}
			}
		}

		$this->pageTitle = 'Create Update';
		$this->render('create', array(
			'model' => $model
		));
	}


	/**
	 * Delete an update
	 * @param  int $id The ID of the update to delete
	 */
	public function actionDelete($id)
	{
		$model = Updates::model()->findByPk($id, 'is_active = 1');
		if ($model != '')
		{
			$model->is_active = 0;
			if ($model->save() != true)
			{
				throw new CHttpException(500, 'Unable to remove update: ' . json_encode($model->getErrors()));
			}
		}
		else
		{
			throw new CHttpException(404, 'Record not found');
		}
	}

}
