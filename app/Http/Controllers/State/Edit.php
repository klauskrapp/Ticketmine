<?php

namespace App\Http\Controllers\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends State
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a state
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request, \App\Models\State $state ):\Illuminate\View\View {

        $mView	= View::make( 'state.edit', array('entity' => $state) );
        return $mView;
    }


}
