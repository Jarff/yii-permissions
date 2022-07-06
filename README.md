## INSTALATION

Run command php ./vendor/bin/console softbox:install. That will copy the necesary migrations

Then add the next function at your Funciones component. It should be located at: protected/components/Funciones.php

function can(String $permission){
    //Buscamos al usuario
    $user = Users::model()->findByPk(Yii::app()->user->id);
    if($user){
        return $user->can($permission);
    }else{
        throw (new Exception("User not found"));
    }
}

Add the Trait/HasRoles to your Users model

use Softbox\YiiPermissions\Traits\HasRoles;
/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $id_user
 * @property integer $id_type_user
 * @property integer $id_customer
 * @property string $alias_user
 * @property string $password_user
 * @property string $name_user
 * @property string $email_user
 * @property integer $status_user
 * @property string $date_user_load
 * @property string $date_low_user
 *
 * The followings are the available model relations:
 * @property Customers $idCustomer
 * @property ReferenceGuides[] $referenceGuides
 */
class Users extends CActiveRecord
{
	use HasRoles;
    ...


Run migrations to install tables

Add the next line to your protected/config/main.php file

...

'components' => [
    'permisos'=>array(
        'class'=>'Permissions',
        'someconfig'=>'someothervalue',
    ),
],

...
