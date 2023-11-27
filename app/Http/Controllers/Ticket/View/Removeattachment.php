<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Removeattachment extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Remove Attachment
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\TicketAttachment $attachment
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request, TicketAttachment $ticketattachment ):\Illuminate\Http\RedirectResponse {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticketattachment->ticket_id );


        if( $ticket ) {
            $ticket->touch();
            $storage        = $this->getStoragePath( $ticket, $ticketattachment->hash );
            $filepath       = $storage . $ticketattachment->hash;
            if( file_exists( $filepath ) == true ) {
                @unlink( $filepath );
            }

            $ticketattachment->delete();



            $arrConfig			        = config('ticket.attachment_removed');

            $arrSettings				= array();
            $arrSettings['who']			= \auth()->user()->name;
            $arrSettings['didwhat']		= __( $arrConfig['didwhat']);
            $arrSettings['content']		= '';
            $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
            $arrSettings['ticket']		= $ticket;


            $cReceiver					= Email::getEmailReceiver( $ticket, 'attachment_removed' );
            $follower					= Email::getReceivers( $cReceiver );

            Email::sendFinalMail($arrConfig, $arrSettings, $follower);

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
