<?php
namespace App\Http\Controllers\Action;
use App\Http\Controllers\Controller;

class Action extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('action.manage_action') );
    }

}
