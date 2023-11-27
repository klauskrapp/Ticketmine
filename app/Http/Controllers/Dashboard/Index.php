<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Dashboard
{

    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request):\Illuminate\View\View
    {
        $dashboard      = \App\Models\Dashboard::where('user_id', '=', auth()->user()->id );
        if( $request->get('unique_id') != '' ) {
            $dashboard->where('unique_id', '=',$request->get('unique_id') );
        }
        else {
            $dashboard->where('is_default', '=',1 );
        }
        $dashboard      = $dashboard->get()->first();


        $mView	= View::make( 'dashboard.index', array(
            'dashboard'    => $dashboard
        ) );
        return $mView;
    }


}
