<?php

namespace Softbox\YiiPermissions\Traits;
require_once __DIR__ . '/../../../../../vendor/autoload.php';

use Softbox\YiiPermissions\Models\ModelHasRole;
use Softbox\YiiPermissions\Models\Role;
use Softbox\YiiPermissions\Models\Permission;
use Softbox\YiiPermissions\Models\RoleHasPermission;
use \Exception;

trait HasRoles{
    // use HasPermissions;

    /**
     * A model may have multiple roles.
     */
    public function role()
    {
        $modelHasRole = ModelHasRole::model()->find("model_id=:modelId AND model_type=:modelType", [
            ':modelId' => $this->id_user,
            ':modelType' => self::class,
        ]);
        if($modelHasRole){
            return Role::model()->findByPk($modelHasRole->role_id);
        }else{
            return null;
        }
        // if(Role::model()->find)
    }

    public function assignRole(int $roleId){
        if(Role::model()->findByPk($roleId)){
            //Verificamos que no tenga asignado ya el rol este usuario
            if(ModelHasRole::model()->count("model_id=:modelId AND model_type=:modelType AND role_id=:roleId", [":modelId" => $this->primaryKey, ':modelType' => self::class, ':roleId' => $roleId]) == 0){
                //Eliminamos si ya existe con un rol diferente
                $currentRole = ModelHasRole::model()->find("model_id=:modelId AND model_type=:modelType", [":modelId" => $this->primaryKey, ':modelType' => self::class]);
                if($currentRole){
                    $currentRole->delete();
                }

                $modelHasRole = new ModelHasRole();
                $modelHasRole->attributes = [
                    'model_id' => $this->primaryKey,
                    'model_type' => self::class,
                    'role_id' => $roleId
                ];
                $modelHasRole->save();
            }
        }else{
            throw "Role not found";
        }
    }

    public function can(String $permissionName){
        //Buscamos el permiso
        $permission = Permission::model()->find("name=:myName", [":myName" => $permissionName]);
        if($permission){
            $count = RoleHasPermission::model()->count("role_id=:roleId AND permission_id=:permissionId", [":roleId" => $this->role()->id, ":permissionId" => $permission->id]);
            return $count > 0 ? true : false;
        }else{
            throw new Exception("YiiPermission: Permission not found -> ".$permissionName);
        }
    }
}