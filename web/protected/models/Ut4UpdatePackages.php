<?php

/**
 * This is the model class for table "ut4_update_packages".
 *
 * The followings are the available columns in table 'ut4_update_packages':
 * @property string $id
 * @property string $update_hash
 * @property string $update_url
 * @property string $date_created
 * @property integer $is_deleted
 */
class Ut4UpdatePackages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ut4_update_packages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('update_hash, update_url', 'required'),
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('update_hash, update_url', 'length', 'max'=>128),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, update_hash, update_url, date_created, is_deleted', 'safe', 'on'=>'search'),
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
			'update_hash' => 'Update Hash',
			'update_url' => 'Update Url',
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
		$criteria->compare('update_hash',$this->update_hash,true);
		$criteria->compare('update_url',$this->update_url,true);
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
	 * @return Ut4UpdatePackages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
