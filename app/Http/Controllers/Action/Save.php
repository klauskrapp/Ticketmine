<?php

namespace App\Http\Controllers\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Action
{

    /**
     * Saves a Action
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('action');
        /** @var \App\Models\Action $entity */
        $entity		    = \App\Models\Action::findOrNew( $data['id'] );
        $entity->addData( $data );
        $entity->save();



        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('action/edit/' . $entity->id );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
