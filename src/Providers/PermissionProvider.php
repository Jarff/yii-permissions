<?php
namespace Softbox\Providers;

use CApplicationComponent;
use Users;
use Yii;

class PermissionProvider extends CApplicationComponent {
    function can(String $permission){
        //Buscamos al usuario
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if($user){
            return $user->can($permission);
        }else{
            throw "User not found";
        }
    }
}