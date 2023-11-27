<?php

namespace App\Http\Controllers\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Priority
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a prio
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Priority $priority
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request, \App\Models\Priority $priority ):\Illuminate\View\View {

        $mView	= View::make( 'priority.edit', array('entity' => $priority) );
        return $mView;
    }


}
