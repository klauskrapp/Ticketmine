<?php
namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

class Manage extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('manage.manage_dashboard') );
    }

}
