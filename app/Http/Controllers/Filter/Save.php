<?php

namespace App\Http\Controllers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Filter
{

    /**
     * Saves a Filter
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  lluminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):void {

        $filter                         = new \App\Models\Filter();
        $filter->user_id                = auth()->user()->id;
        $filter->name                   = $request->get('name');
        $filter->querystring            = $request->get('querystring');
        $filter->save();

        $arrResult                      = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = '';
        $request->session()->flash('message',  $arrResult );
    }


}
