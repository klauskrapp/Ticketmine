<?php
namespace App\Http\Controllers\Quickfind;
use App\Http\Controllers\Controller;

class Quickfind extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('state.manage_state') );
    }

}
