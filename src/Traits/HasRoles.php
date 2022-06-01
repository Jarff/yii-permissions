<?php

namespace Softbox\YiiPermissions\Traits;

// use Softbox\YiiPermissions\Contracts\Permission;
// use Softbox\YiiPermissions\Contracts\Role;
use Softbox\YiiPermissions\Models\ModelHasRole;

trait HasRoles{
    // use HasPermissions;

    /**
     * A model may have multiple roles.
     */
    public function roles(): CActiveRecord
    {
        $role = ModelHasRole::model()->find("model_id=:modelId AND model_type=:modelType", [
            ':modelId' => $this->id,
            ':modelType' => self::class,
        ]);

        return $role;
    }
}