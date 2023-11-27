<?php

namespace App\Http\Controllers\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Manage
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a dashboard
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

        $mView	= View::make( 'manage.edit', array('entity' => $dashboard) );
        return $mView;
    }


}
