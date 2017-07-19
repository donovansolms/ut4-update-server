<?php

/**
 * This is the model class for table "ut4_version_check_log".
 *
 * The followings are the available columns in table 'ut4_version_check_log':
 * @property string $id
 * @property string $client_id
 * @property string $current_version
 * @property string $installed_versions
 * @property string $ip
 * @property string $kernel_version
 * @property string $dist_id
 * @property string $dist
 * @property string $dist_version
 * @property string $dist_pretty
 * @property string $date_created
 */
class Ut4VersionCheckLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ut4_version_check_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, current_version, date_created', 'required'),
			array('client_id, kernel_version, dist_id, dist, dist_version, dist_pretty', 'length', 'max'=>64),
			array('current_version', 'length', 'max'=>32),
			array('installed_versions', 'length', 'max'=>512),
			array('ip', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, client_id, current_version, installed_versions, ip, kernel_version, dist_id, dist, dist_version, dist_pretty, date_created', 'safe', 'on'=>'search'),
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
			'client_id' => 'Client',
			'current_version' => 'Current Version',
			'installed_versions' => 'Installed Versions',
			'ip' => 'Ip',
			'kernel_version' => 'Kernel Version',
			'dist_id' => 'Dist',
			'dist' => 'Dist',
			'dist_version' => 'Dist Version',
			'dist_pretty' => 'Dist Pretty',
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
		$criteria->compare('client_id',$this->client_id,true);
		$criteria->compare('current_version',$this->current_version,true);
		$criteria->compare('installed_versions',$this->installed_versions,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('kernel_version',$this->kernel_version,true);
		$criteria->compare('dist_id',$this->dist_id,true);
		$criteria->compare('dist',$this->dist,true);
		$criteria->compare('dist_version',$this->dist_version,true);
		$criteria->compare('dist_pretty',$this->dist_pretty,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ut4VersionCheckLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
