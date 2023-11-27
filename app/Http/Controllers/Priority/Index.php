<?php

namespace App\Http\Controllers\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Priority
{


    public function __construct()
    {
        parent::__construct();
    }



    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function execute(Request $request):\Illuminate\View\View
    {
        $mView	= View::make( 'priority.index' );
        return $mView;
    }


}
