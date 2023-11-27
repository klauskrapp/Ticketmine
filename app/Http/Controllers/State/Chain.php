<?php

namespace App\Http\Controllers\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Chain extends State
{

    /**
     *
     * Edit Statechain
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return \Illuminate\View\View $mView
     *

     *
     *
     */
    public function execute(Request $request, \App\Models\State $state ):\Illuminate\View\View {
        // Get all other states in project
        $others     = \App\Models\State::where('project_id', '=', $state->project_id)->get();


        $mView	= View::make( 'state.chain', array(
            'entity' => $state,
            'states'    => $others
        ) );
        return $mView;
    }


}
