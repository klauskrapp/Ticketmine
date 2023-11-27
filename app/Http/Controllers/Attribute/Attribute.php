<?php
namespace App\Http\Controllers\Attribute;
use App\Http\Controllers\Controller;

class Attribute extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('attribute.manage_attribute') );
    }

}
