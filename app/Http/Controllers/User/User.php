<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

class User extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('user.manage_user') );
    }

}
