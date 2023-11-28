<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Removecomment extends \App\Http\Controllers\Ticket\View\View
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
    public function execute(Request $request, TicketComment $ticketcomment ):\Illuminate\Http\RedirectResponse {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticketcomment->ticket_id );

        if( $ticket ) {
            $ticket->touch();

            $ticketcomment->delete();



            $arrConfig			        = config('ticket.comment_removed');

            $arrSettings				= array();
            $arrSettings['who']			= \auth()->user()->name;
            $arrSettings['didwhat']		= __( $arrConfig['didwhat']);
            $arrSettings['content']		= '';
            $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
            $arrSettings['ticket']		= $ticket;


            $cReceiver					= Email::getEmailReceiver( $ticket, 'comment_removed' );
            $follower					= Email::getReceivers( $cReceiver );

            Email::sendFinalMail($arrConfig, $arrSettings, $follower);

            $desc       = $ticket->name . ' (' . $ticket->unique_id . ')';
            \App\Helpers\Ticket::toActivityStream( $ticket->id, \auth()->user()->id, $ticket->project_id, 'comment_deleted', $desc );


            $arrResult                      = array();
            $arrResult['message_type']      = 'success';
            $arrResult['message']           = __('global.entity_saved');
            $arrResult['move_to']           = url('browse/' . $ticket->unique_id  );


            $request->session()->flash('message',  $arrResult );
            return redirect( $arrResult['move_to'] );

        }

        $arrResult['move_to']           = url('search');
        return redirect( $arrResult['move_to'] );
    }


}
