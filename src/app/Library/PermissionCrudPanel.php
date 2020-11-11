<?php

namespace Backpack\PermissionManager\app\Library\CrudPanel;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\PermissionManager\PanelTraits\Permissions;

class PermissionCrudPanel extends CrudPanel
{
    // load all the default CrudPanel features
    use Permissions;

    public $controller; // a reference to the controller from which this CrudPanel was instantiated
    // The following methods are used in CrudController or your EntityCrudController to manipulate the variables above.
}
