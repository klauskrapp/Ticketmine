<?php

namespace App\Http\Controllers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Moveto extends Filter
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, \App\Models\Filter $filter ):\Illuminate\Http\RedirectResponse {
        $url            = url('search');
        if( $filter->user_id == auth()->user()->id ) {
            $url        = url('search') . $filter->querystring;
        }
        return redirect( $url );
    }


}
