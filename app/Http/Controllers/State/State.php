<?php
namespace App\Http\Controllers\State;
use App\Http\Controllers\Controller;

class State extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('state.manage_state') );
    }

}
