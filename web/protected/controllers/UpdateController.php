<?php

class UpdateController extends Controller
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
	    			'actions'=>array('process'),
	    			'users'=>array('*'),
	    		),
	    		array('deny',
	    			'users' => array('*')
	    		)
    	);
    }

	/**
	 * Processes update calls from Unattended clients
	 */
	public function actionProcess()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$post_data = Yii::app()->request->rawBody;
			if ($post_data == '')
			{
				throw new CHttpException(400, 'Missing Omaha Request Data');
			}

			$xml = simplexml_load_string($post_data);
			// Route based on Event type
			$event_type = $xml->app->event->attributes()['eventtype'];
			$event_result = $xml->app->event->attributes()['eventresult'];
			$event_output = $this->processEventRequest($event_type, $event_result, $xml->app);

			// TODO: eventOutput needs to be serialized to XML
			echo $event_output;
		}
		else
		{
			$this->layout='//layouts/login';
			// If this is a user, redirect to manage
			if (Yii::app()->user->isGuest == false)
			{
				$this->redirect('manage');
			}
			$this->pageTitle = 'Update';
			$this->render('process');
		}
	}

	/**
	 * Process the event based on type and result
	 * @param  OmahaEventTypes 			$event_type 	The incoming event type
	 * @param  OmahaEventResultTypes 	$event_result 	The incoming event result
	 * @param  XMLElement 				$app          	The app section of the request
	 * @return [type]               [description]
	 */
	private function processEventRequest($event_type, $event_result, $app)
	{
		switch ($event_type)
		{
			case OmahaEventTypes::UNKNOWN:
				echo 'Unknown';
				break;
			case OmahaEventTypes::UPDATE_CHECK:
				$update = $this->getUpdateData($app, $event_type, $event_result);
				if ($update === null)
				{
					http_response_code(400);
					return $this->buildFailureResponse('Invalid request, possibly missing data in payload');
				}
				else
				{
					return $update->toXML();
				}
				break;
			default:
				echo 'Nothing';
		}
	}

	/**
	 * Retrieves update information, if any is available,
	 * based on the provided app information.
	 * @param  OmahaResponse 	$app	The application section of the request.
	 * @return UpdateResult     		The update information, or null if none.
	 */
	private function getUpdateData($app, $event_type, $event_result)
	{
		$response = null;
		$app_id = $app->attributes()['appid'];
		$version = $app->attributes()['version'];
		$track = $app->attributes()['track'];
		$bootid = $app->attributes()['bootid'];
		if ($app_id == '' || $version == '' || $track == '' || $bootid == '')
		{
			return null;
		}

		// Fetch this app, on this track form the database
		$criteria = new CDbCriteria();
		$criteria->condition = 'app_id = :appid AND track = :track AND version > :version AND is_active = 1';
		$criteria->params = array(':appid' => $app_id, 'track' => $track, 'version' => $version);
		$criteria->order = 'version DESC';
		$model = Updates::model()->find($criteria);
		if ($model != '')
		{
			$traceid = $bootid . '-' . GeneralHelper::CryptToken('alnum', 32);
			$response = new OmahaResponse(OmahaEventResultTypes::AVAILABLE);
			$response->AppID = $app_id;
	        $response->Status = 'ok';
	        $response->DownloadUrl = $model->download_location;
	        $response->Version = $model->version;
	        $response->SHA256Hash = $model->sha256_hash;
	        $response->Filename = $model->filename;
	        $response->SizeBytes = $model->size_in_bytes;
			$response->TraceID = $traceid;
			$this->logUpdate($event_type, $event_result, $response, $version, $track, $bootid, $traceid);
		}
		else
		{
			$response = new OmahaResponse(OmahaEventResultTypes::NO_UPDATE);
			$response->AppID = $app_id;
	        $response->Status = 'ok';
		}
		return $response;
	}


	/**
	 * Logs the update response to the database.
	 * @param  OmahaResponse $update	The update response object.
	 * @return boolval					true if logged, false otherwise.
	 */
	private function logUpdate($event_type, $event_result, $update, $version, $track, $bootid, $traceid)
	{
		$model = new UpdateLog();
		$model->event_type = $event_type;
		$model->event_result = $event_result;
		$model->app_id = $update->AppID;
		$model->track = $track;
		$model->current_version = $version;
		$model->update_version = $update->Version;
		$model->bootid = $bootid;
		$model->trace_id = $traceid;
		$model->date_created = new CDbExpression('NOW()');
		return $model->save();
	}

	/**
	 * Builds and returns the failure XML response.
	 *
	 * @param  string $message The failure reason.
	 * @return string          The faiure XML response.
	 */
	private function buildFailureResponse($message)
	{
		$server = Yii::app()->params['UPDATE_SERVER'];
		return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<response protocol="3.0" server="$server">
    <app status="failed">
        <reason>$message</reason>
    </app>
</response>
EOT;
	}

}
