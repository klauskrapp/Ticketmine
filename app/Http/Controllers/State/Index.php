<?php

namespace App\Http\Controllers\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends State
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
     * @return \Illuminate\View\View $mView
     */
    public function execute(Request $request):\Illuminate\View\View
    {
        $mView	= View::make( 'state.index' );
        return $mView;
    }


}
