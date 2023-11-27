<?php
namespace App\Http\Controllers\Project;
use App\Http\Controllers\Controller;

class Project extends Controller {



    public function __construct()
    {
        view()->share('_title',  __('project.manage_project') );
    }

}
