<?php
namespace App\Http\Controllers\Manage\Configure;
use App\Http\Controllers\Controller;

class Configure extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('manage.configure_dashboard') );
    }

}
