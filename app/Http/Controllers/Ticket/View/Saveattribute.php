<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Jobs\TicketIndex;
use App\Models\Attribute;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Saveattribute extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Remove Comment
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\TicketAttachment $attachment
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, Ticket $ticket, Attribute $attribute ):array {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticket->id );
        $return         = array(
            'html'      => ''
        );
        if( $ticket ) {
            $ticketAfter    = clone $ticket;
            $arrAttribute   = array(
                $attribute->id      => $request->get('content')
            );



            $ticketAfter->addAttributes();
            $before     = \App\Helpers\Attribute::getAttributesValue( $ticketAfter, $attribute, true, true );


            \App\Helpers\Attribute::saveAttributes( $ticket->id, $arrAttribute );
            $ticket     = Ticket::find( $ticket->id );
            $ticket->addAttributes();
            $after              =  \App\Helpers\Attribute::getAttributesValue( $ticket, $attribute, true, true );
            $return['html']      = $after;

            $desc                       = __('dashboard.value_of_attribute') . ' ' . $attribute->name . ' ' . __('dashboard.changed');
            $desc		                = str_replace( array('{from}', '{to}'), array( $before, $after ), $desc );

            \Queue::later(30, new TicketIndex( $ticket->id ) );
            \App\Helpers\Ticket::toActivityStream( $ticket->id, auth()->user()->id, $ticket->project_id, 'state_changed', $desc );
        }
        return $return;
    }


}
