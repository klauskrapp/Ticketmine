<?php

namespace App\Http\Controllers\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Attribute
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return \Illuminate\View\View $mView
     */
    public function execute(Request $request):\Illuminate\View\View {
        $mView	= View::make( 'attribute.index' );
        return $mView;
    }


}
