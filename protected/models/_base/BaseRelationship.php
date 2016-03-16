<?php

/**
 * This is the model base class for the table "tbl_relationship".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Relationship".
 *
 * Columns in table "tbl_relationship" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $user_id_1
 * @property integer $user_id_2
 * @property string $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $user_type
 *
 */
abstract class BaseRelationship extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_relationship';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Relationship|Relationships', $n);
	}

	public static function representingColumn() {
		return 'type';
	}

	public function rules() {
		return array(
			array('user_id_1, user_id_2, status, created_at, updated_at', 'numerical', 'integerOnly'=>true),
			array('type, user_type', 'length', 'max'=>255),
			array('user_id_1, user_id_2, type, status, created_at, updated_at, user_type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id_1, user_id_2, type, status, created_at, updated_at, user_type', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id_1' => Yii::t('app', 'User Id 1'),
			'user_id_2' => Yii::t('app', 'User Id 2'),
			'type' => Yii::t('app', 'Type'),
			'status' => Yii::t('app', 'Status'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'user_type' => Yii::t('app', 'User Type'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id_1', $this->user_id_1);
		$criteria->compare('user_id_2', $this->user_id_2);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created_at', $this->created_at);
		$criteria->compare('updated_at', $this->updated_at);
		$criteria->compare('user_type', $this->user_type, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}