<?php

namespace App\Http\Controllers\Manage\Configure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Configure
{

    /**
     * Saves a Priority
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  :\Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request,  \App\Models\Dashboard $dashboard ):\Illuminate\Http\RedirectResponse {
        if( $dashboard->user_id == auth()->user()->id ) {

            $data = $request->get('element');
            /** @var \App\Models\Dashboard $entity */
            $entity = \App\Models\DashboardElement::findOrNew($data['id']);
            $entity->dashboard_id = $dashboard->id;
            $entity->addData($data);
            if( isset( $data['filter_id'] ) == true && $data['filter_id'] == '' ) {
                $entity->filter_id = null;
            }
            $entity->save();


        }

        $arrResult                  = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = url('manage/configure/' . $dashboard->id );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


}
