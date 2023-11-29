<?php

namespace App\Http\Controllers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Filter
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Filter $filter
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, \App\Models\Filter $filter ):\Illuminate\Http\RedirectResponse {
        if( $filter->user_id == auth()->user()->id ) {
            $filter->delete();
        }
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        $request->session()->flash('message',  $result );
        return redirect( url('search') );
    }


}
