<?php

namespace App\Http\Controllers\Ticket\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Create
{


    /**
     *
     * Create new ticket
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return \Illuminate\View\View $mView
     *
     */
    public function execute(Request $request ):\Illuminate\View\View {
        $mView	= View::make( 'ticket.create.index'  );
        return $mView;
    }


}
