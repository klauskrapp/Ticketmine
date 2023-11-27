<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Controller
{

    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     *
     */
    public function execute(Request $request)
    {
        $mView	= View::make( 'login.index' );
        return $mView;
    }


}
