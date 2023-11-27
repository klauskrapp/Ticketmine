<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Downloadattachment extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * CDownload an attachment
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\TicketAttachment $attachment
     * @return  String
     *
     *
     */
    public function execute(Request $request, TicketAttachment $ticketattachment ) {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticketattachment->ticket_id );


        if( $ticket ) {

            $storage        = $this->getStoragePath( $ticket, $ticketattachment->hash );
            $filepath       = $storage . $ticketattachment->hash;



            $headers = array(
                'Content-Type: ' . $ticketattachment->mime,
                'Content-Disposition:attachment; filename="'.$ticket->name.'"',
                'Content-Transfer-Encoding:binary',
                'Content-Length:'.filesize( $filepath ),
            );

            return \Response::download( $filepath ,$ticketattachment->name, $headers);
        }
        return '';
    }


}
