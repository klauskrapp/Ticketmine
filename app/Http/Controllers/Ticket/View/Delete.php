<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Editor;
use App\Helpers\Email;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Delete extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Remove a ticket
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Ticket $ticket
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, Ticket $ticket ):\Illuminate\Http\RedirectResponse {


        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticket->id );
        $arrResult = array();
        $arrResult['message_type'] = 'success';
        $arrResult['message'] = __('global.ticket_deleted');
        $arrResult['move_to'] = url('search');

        if( $ticket ) {
            $desc       = $ticket->name . ' (' . $ticket->unique_id . ')';
            \App\Helpers\Ticket::toActivityStream( $ticket->id, $ticket->created_by, $ticket->project_id, 'ticket_deleted', $desc );
            $this->sendDeleteEmail( $ticket );
            $ticket->delete();
        }
        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );
    }


    /**
     * Send Creation Mail
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     *
     */
    protected function sendDeleteEmail( $ticket ) {
        $desc                       = $ticket->name . ' (' . $ticket->unique_id . ')';
        $arrConfig			        = config('ticket.ticket_deleted');
        $creator					= User::find( $ticket->created_by );
        $arrSettings				= array();
        $arrSettings['who']			= \auth()->user()->name;
        $arrSettings['didwhat']		= __($arrConfig['didwhat']);
        $arrSettings['content']     = $desc;
        $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
        $arrSettings['ticket']		= $ticket;


        $cReceiver					= Email::getEmailReceiver( $ticket, 'ticket_deleted' );
        $follower					= Email::getReceivers( $cReceiver );

        Email::sendFinalMail($arrConfig, $arrSettings, $follower);
    }


}
