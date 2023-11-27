<?php
namespace App\Http\Controllers\Priority;
use App\Http\Controllers\Controller;

class Priority extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('priority.manage_priority') );
    }

}
