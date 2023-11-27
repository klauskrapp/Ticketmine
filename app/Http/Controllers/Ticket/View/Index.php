<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Editor;
use App\Models\Ticket;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;


class Index extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Detailed view for a ticket
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param String $unique_id unique id of the ticket
     *
     * @return  \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, $unique_id ):\Illuminate\View\View|\Illuminate\Http\RedirectResponse {

        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'unique_id', $unique_id  );
        if( $ticket ) {
            $ticket->addAttributes();
            $arrAttributes          = array();
            $attributes             = \App\Helpers\Attribute::getProjectesAttributes( array( $ticket->project_id ) );
            if( isset( $attributes[ $ticket->project_id ] ) == true ) {
                $arrAttributes      = $attributes[$ticket->project_id];
            }

            $mView = View::make('ticket.view.index', array(
                'entity'        => $ticket,
                'attributes'    => $arrAttributes,
                '_title'        => $ticket->name . ' (' . $ticket->unique_id . ')'
            ));
            return $mView;

        }
        else {
            \Session::flash( 'error', 'Ticket existiert nicht mehr' );
            $arrResult                  = array();
            $arrResult['message_type']      = 'error';
            $arrResult['message']           = __('global.ticket_does_not_exist');


            $request->session()->flash('message',  $arrResult );
            return \Redirect::to( 'search' );
        }
    }


}
