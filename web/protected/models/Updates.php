<?php

/**
 * This is the model class for table "updates".
 *
 * The followings are the available columns in table 'updates':
 * @property string $id
 * @property string $app_id
 * @property string $version
 * @property string $filename
 * @property string $download_location
 * @property string $size_in_bytes
 * @property string $sha256_hash
 * @property string $date_created
 * @property string $date_updated
 * @property integer $is_active
 */
class Updates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'updates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, track, filename, download_location, size_in_bytes, sha256_hash, date_created', 'required', 'on' => 'create'),
			array('app_id, track, filename, download_location, size_in_bytes, sha256_hash, date_updated', 'required', 'on' => 'update'),
			array('is_active, upgrade_count', 'numerical', 'integerOnly'=>true),
			array('app_id, sha256_hash', 'length', 'max'=>128),
			array('version, track', 'length', 'max'=>32),
			array('filename', 'length', 'max'=>64),
			array('download_location', 'length', 'max'=>1024),
			array('size_in_bytes', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, app_id, version, filename, download_location, size_in_bytes, sha256_hash, upgrade_count, version, date_created, date_updated, is_active', 'safe', 'on'=>'search'),

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
			'app_id' => 'App',
			'version' => 'Version',
			'filename' => 'Filename',
			'download_location' => 'Download Location',
			'size_in_bytes' => 'Size In Bytes',
			'sha256_hash' => 'Sha256 Hash',
			'upgrade_count' => 'Total Upgrades',
			'date_created' => 'Added',
			'date_updated' => 'Date Updated',
			'is_active' => 'Is Active',
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('download_location',$this->download_location,true);
		$criteria->compare('size_in_bytes',$this->size_in_bytes,true);
		$criteria->compare('sha256_hash',$this->sha256_hash,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('is_active',1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => Yii::app()->params['PAGE_SIZE']
			),
			'sort' => array(
				'defaultOrder' => 'id DESC',
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Updates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
