<?php
namespace App\Http\Controllers\Groupstate;
use App\Http\Controllers\Controller;

class Groupstate extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('groupstate.manage_groupstate') );
    }

}
