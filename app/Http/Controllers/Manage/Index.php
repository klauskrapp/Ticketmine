<?php

namespace App\Http\Controllers\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Manage
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
        $mView	= View::make( 'manage.index' );
        return $mView;
    }


}
