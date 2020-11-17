<?php

namespace Backpack\PermissionManager\app\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    use CrudTrait;

    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];

    public function getLevelAttribute($value)
    {
        return $this->id;
    }
}
