<?php namespace Backpack\Permissions\app\Models;

use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    use CrudTrait;

    protected $fillable = [ 'name','updated_at','created_at'];
	
}
