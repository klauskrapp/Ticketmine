<?php

namespace App\Http\Controllers\Groupstate;
use Illuminate\Http\Request;



class Save extends Groupstate
{

    /**
     * Saves a Groupstate
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  lluminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('groupstate');

        /** @var \App\Models\Groupstate $entity */
        $entity		    = \App\Models\Groupstate::findOrNew( $data['id'] );
        $entity->addData( $data );
        $entity->save();
        \DB::table('state_is_in_state_group')->where('state_group_id', '=', $entity->id )->delete();

        $states         = $request->get('states', array() );
        $toSave         = array();
        foreach( $states as $state ) {
            $toSave[]       = array(
                'state_group_id'    => $entity->id,
                'state_id'          => $state
            );
        }

        if( empty( $toSave ) == false ) {
            \DB::table('state_is_in_state_group')->insert( $toSave );
        }


        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('groupstate/edit/' . $entity->id );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
