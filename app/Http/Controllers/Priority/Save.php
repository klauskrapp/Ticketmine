<?php

namespace App\Http\Controllers\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Priority
{

    /**
     * Saves a Priority
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('priority');
        /** @var \App\Models\Priority $entity */
        $entity		    = \App\Models\Priority::findOrNew( $data['id'] );
        $entity->addData( $data );
        $entity->save();



        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('priority/edit/' . $entity->id );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
