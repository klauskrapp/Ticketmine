<?php
namespace App\Http\Controllers\Filter;
use App\Http\Controllers\Controller;

class Filter extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('filter.manage_filters') );
    }

}
