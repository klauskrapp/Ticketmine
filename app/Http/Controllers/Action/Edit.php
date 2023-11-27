<?php

namespace App\Http\Controllers\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Action
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a actionrtype
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Action $action
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request, \App\Models\Action $action ):\Illuminate\View\View {

        $mView	= View::make( 'action.edit', array('entity' => $action) );
        return $mView;
    }


}
