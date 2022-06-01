<?php
namespace Softbox\YiiPermissions\Models;
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
class RoleHasPermission extends CActiveRecord
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
			array('permission_id, role_id, guard_name, created_at, updated_at', 'safe'),
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
		//Codigo aqui
		if($this->ingresarPassword != ''){
		   //$this->password_user = md5($this->ingresarPassword);
		   $this->password_user = $this->ingresarPassword;
		}
		
		return parent::beforeSave();
	}	
	
}