<?php
namespace Softbox\YiiPermissions\Models;
require_once __DIR__ . '/../../vendor/autoload.php';
use Softbox\YiiPermissions\Models\RoleHasPermission;
use Softbox\YiiPermissions\Models\Permission;
use CActiveRecord;
use Yii;

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 *
 */
class Role extends CActiveRecord
{

	
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
		return 'roles';
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

	public function hasPermission(Permission $permission){
		if(RoleHasPermission::model()->find("role_id=:roleId AND permission_id=:permissionId", [":roleId" => $this->id, ":permissionId" => $permission->id])){
			return true;
		}else{
			return false;
		}
	}

	public function givePermissionTo(Permission $permission){
		if($this->hasPermission($permission)){
			return RoleHasPermission::model()->find("role_id=:roleId AND permission_id=:permissionId", [":roleId" => $this->id, ":permissionId" => $permission->id]);
		}else{
			$roleHasPermission = new RoleHasPermission();
			$roleHasPermission->role_id = $this->id;
			$roleHasPermission->permission_id = $permission->id;
			if($roleHasPermission->save()){
				return $roleHasPermission;
			}else{
				return null;
			}
		}
	}

	public function revokePermissionTo(Permission $permission){
		if($this->hasPermission($permission)){
			RoleHasPermission::model()->deleteAll("role_id=:roleId AND permission_id=:permissionId", [":roleId" => $this->id, ":permissionId" => $permission->id]);
		}
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