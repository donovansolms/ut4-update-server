<?php

/**
 * This is the model class for table "ut4_versionmap".
 *
 * The followings are the available columns in table 'ut4_versionmap':
 * @property string $id
 * @property string $version
 * @property string $semver
 * @property string $date_released
 * @property string $date_created
 * @property integer $is_deleted
 */
class Ut4Versionmap extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ut4_versionmap';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('version, semver, date_released, date_created', 'required'),
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('version, semver', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, version, semver, date_released, date_created, is_deleted', 'safe', 'on'=>'search'),
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
			'version' => 'Version',
			'semver' => 'Semver',
			'date_released' => 'Date Released',
			'date_created' => 'Date Created',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('version',$this->version,true);
		$criteria->compare('semver',$this->semver,true);
		$criteria->compare('date_released',$this->date_released,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ut4Versionmap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
