<?php

class Ut4Controller extends Controller
{
	public function filters()
    {
        return array(
            'accessControl',
        		//'postOnly + check', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
		return array(
				array('allow',
	    			'actions'=>array(
							),
	    			'users'=>array('*'),
	    		),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	/**
	 * Checks is a new UT4 version is available for the POSTed version
	 */
	public function actionCheck()
	{

		if (Yii::app()->request->isPostRequest)
		{


			$post_data = Yii::app()->request->rawBody;
			if ($post_data == '')
			{
				throw new CHttpException(400, 'Missing Update Check Request body');
			}
			// Parse the POST data
			$updateCheckRequest = json_decode($post_data);

			$checkLog = new Ut4VersionCheckLog();
			$checkLog->client_id = $updateCheckRequest->client_id;
			$checkLog->current_version = $updateCheckRequest->current_version;
			$checkLog->installed_versions = json_encode($updateCheckRequest->versions);
			$checkLog->ip = Yii::app()->request->userHostAddress;
			$checkLog->kernel_version = $updateCheckRequest->os->KernelVersion;
			$checkLog->dist_id = $updateCheckRequest->os->DistributionID;
			$checkLog->dist = $updateCheckRequest->os->Distribution;
			$checkLog->dist_version = $updateCheckRequest->os->DistributionVersion;
			$checkLog->dist_pretty = $updateCheckRequest->os->DistributionPrettyName;
			$checkLog->has_electron = $updateCheckRequest->os->HasElectron;
			$checkLog->date_created = new CDbExpression('NOW()');
			$checkLog->save();

			$response = array(
				"latest_version" => $updateCheckRequest->current_version,
				"update_available" => false,
			);

			$criteria = new CDbCriteria();
			$criteria->condition = 'from_version = ? AND to_version > ? AND is_deleted = 0';
			$criteria->params = array($updateCheckRequest->current_version, $updateCheckRequest->current_version);
			$criteria->order = 'from_version DESC';
			$criteria->limit = 1;
			$model = Ut4UpdatePackages::model()->find($criteria);
			if ($model != '')
			{
				$response["latest_version"] = $model->to_version;
				$response["update_available"] = true;
				$response["update_url"] = $model->update_url;
			}
			header("Content-Type: application/json");
			echo json_encode($response);
			return;

		}
	}

	/**
	 * Returns the key value map of versions to semantic versions
	 */
	public function actionVersionMap()
	{
		$models = Ut4Versionmap::model()->findAll("is_deleted = 0");
		$versions = array();

		foreach ($models as $model)
		{
			array_push($versions, array(
				"version" => $model->version,
				"semver" => $model->semver,
				"released" => date("Y-m-d", strtotime($model->date_released)) . "T00:00:00Z"
			));
		}
		header("Content-Type: application/json");
		echo json_encode($versions);
	}

	/*
	/**
	 * Returns the JSON files+hashes for the given version
	 *
	public function actionVersionHash($version)
	{
		$model = '';
		if ($version == "latest")
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'is_deleted = 0';
			$criteria->order = 'version DESC';
			$criteria->limit = 1;
			$model = Ut4VersionHashes::model()->find($criteria);
		}
		else
		{
			$model = Ut4VersionHashes::model()->find('version = ? AND is_deleted = 0', array($version));
		}
		if ($model == '')
		{
			throw new CHttpException(404);
		}
		header("Content-Type: application/json");
		echo $model->hashes;
	}

	/**
	 * Returns the delta update package to download based on the hash provided
	 *
	public function actionUpdateDeltaHash($deltaHash)
	{
		$model = Ut4UpdatePackages::model()->find('update_hash = ? AND is_deleted = 0', array($deltaHash));
		if ($model == '')
		{
			throw new CHttpException(404);
		}
		echo json_encode(array(
			"update_url" => $model->update_url,
		));
	}

	*/
}
