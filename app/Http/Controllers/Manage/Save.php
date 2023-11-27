<?php

namespace App\Http\Controllers\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Manage
{

    /**
     * Saves an dashboard
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  lluminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('dashboard');
        /** @var \App\Models\Dashboard $entity */
        $entity		    = \App\Models\Dashboard::findOrNew( $data['id'] );
        $entity->user_id    = auth()->user()->id;
        if( $entity->id == '' ) {
            $entity->unique_id      = md5( time() . '_' . uuid_create() );
        }
        $entity->addData( $data );
        $entity->save();



        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('manage.entity_saved_now_add_some_elements');
        $arrResult['move_to']           = url('manage' );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
