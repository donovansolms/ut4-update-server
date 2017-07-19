<?php

/**
 * This is the model class for table "update_log".
 *
 * The followings are the available columns in table 'update_log':
 * @property string $id
 * @property string $event_type
 * @property string $event_result
 * @property string $app_id
 * @property string $track
 * @property string $current_version
 * @property string $bootid
 * @property string $date_created
 */
class UpdateLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'update_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_type, event_result, app_id, track, current_version, update_version, bootid, date_created', 'required'),
			array('event_type, event_result', 'length', 'max'=>3),
			array('app_id, trace_id', 'length', 'max'=>128),
			array('bootid', 'length', 'max'=>64),
			array('track', 'length', 'max'=>16),
			array('current_version', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, event_type, event_result, app_id, track, current_version, bootid, date_created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_type' => 'Event Type',
			'event_result' => 'Event Result',
			'app_id' => 'App',
			'track' => 'Track',
			'current_version' => 'Current Version',
			'bootid' => 'Bootid',
			'date_created' => 'Date Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('event_type',$this->event_type,true);
		$criteria->compare('event_result',$this->event_result,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('track',$this->track,true);
		$criteria->compare('current_version',$this->current_version,true);
		$criteria->compare('bootid',$this->bootid,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UpdateLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
