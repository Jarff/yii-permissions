<?php
class Permissions extends CApplicationComponent
{
    public $someconfig='somedefault';
	
    public function init() {
        // Init this component
    }
	
	function can(String $permission){
        //Buscamos al usuario
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if($user){
            return $user->can($permission);
        }else{
            throw (new Exception("User not found"));
        }
    }

}
?>