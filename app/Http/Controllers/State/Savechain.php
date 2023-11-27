<?php

namespace App\Http\Controllers\State;
use Illuminate\Http\Request;



class Savechain extends State
{

    /**
     * Saves statechains
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {


        $chain                      = $request->get('statechain', array() );
        \DB::table('state_chain')->where('from', '=', $request->get('entity_id') )->delete();
        $arrInsert                  = array();
        foreach( $chain as $item ) {
            $arrInsert[]        = array(
                'from'      => $request->get('entity_id'),
                'to'        => $item
            );
        }

        if( empty( $arrInsert ) == false ) {
            \DB::table('state_chain')->insert( $arrInsert );
        }


        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('state/chain/' . $request->get('entity_id') );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
