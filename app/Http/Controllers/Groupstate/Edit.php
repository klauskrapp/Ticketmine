<?php

namespace App\Http\Controllers\Groupstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Groupstate
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a groupstate
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Groupstate $groupstate
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request, \App\Models\Groupstate $groupstate ):\Illuminate\View\View {

        $mView	= View::make( 'groupstate.edit', array('entity' => $groupstate) );
        return $mView;
    }


}
