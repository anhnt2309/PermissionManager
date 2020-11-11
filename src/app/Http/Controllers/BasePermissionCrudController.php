<?php

namespace Backpack\CRUD\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class BasePermissionCrudController extends CrudController
{
    public function __construct()
    {
        if ($this->crud) {
            return;
        }
        $this->crud->controller = $this;
        // ---------------------------
        // Create the CrudPanel object
        // ---------------------------
        // Used by developers inside their ProductCrudControllers as
        // $this->crud or using the CRUD facade.
        //
        // It's done inside a middleware closure in order to have
        // the complete request inside the CrudPanel object.
        $this->middleware(function ($request, $next) {
            // Initializes the CRUD permissions
            if (method_exists($this->crud, 'initPermissions')) {
                $this->crud->initPermissions();
            }

            return $next($request);
        });
        parent::__construct();
    }
}