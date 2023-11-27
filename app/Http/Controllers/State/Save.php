<?php

namespace App\Http\Controllers\State;
use Illuminate\Http\Request;



class Save extends State
{

    /**
     * Saves a State
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('state');
        /** @var \App\Models\State $entity */
        $entity		    = \App\Models\State::findOrNew( $data['id'] );
        $entity->addData( $data );
        $entity->save();



        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('state/edit/' . $entity->id );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
