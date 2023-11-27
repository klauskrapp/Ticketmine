<?php

namespace App\Http\Controllers\Manage\Configure;
use App\Http\Controllers\Manage\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Configure
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request, \App\Models\Dashboard $dashboard ):\Illuminate\View\View {

        $mView	= View::make( 'manage.configure.index', array('entity' => $dashboard) );
        return $mView;
    }


}
