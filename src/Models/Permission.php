<?php
namespace Softbox\YiiPermissions\Models;

require_once __DIR__ . '/../../vendor/autoload.php';
use CActiveRecord;
use Yii;

class Permission extends CActiveRecord {
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->db;
	}

    	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permissions';
	}

    	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// Atributos marcados como seguros
			array('id, name, guard_name, created_at, updated_at', 'safe'),
		);
	}

    	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [];
	}

	public function unsyncFromRoles(){
		RoleHasPermission::model()->deleteAll("permission_id=:permissionId", [":permissionId" => $this->id]);
	}

    	/**
	 * Acciones a ejecutar despues de buscar
	 */	
	public function afterFind(){
		//Codigo aqui
		return parent::afterFind();
	}	
	
	/**
	 * Acciones a ejecutar antes de Guardar
	 */	
	public function afterSave(){
		//Codigo aqui
		return parent::afterSave();
	}	
	
	/**
	 * Acciones a ejecutar despues de Guardar
	 */	
	public function beforeSave(){
		$this->updated_at = date("Y-m-d H:i:s");
		return parent::beforeSave();
	}	

	public function behaviors() {
		return array(
			'PaginateBehavior' => [
				'class' => 'application.behaviors.PaginateBehavior'
			],
			'ArrayBehavior'=> [
				'class'=>'application.behaviors.ArrayBehavior'
			],
		);
	}
}