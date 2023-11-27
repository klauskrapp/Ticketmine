<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Getcomment extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Create new ticket
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  array $result
     *
     *
     */
    public function execute(Request $request ):array {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );
        $arrResult      = array(
            'html'      => '',
            'html_replaced' => ''
        );
        if( $ticket ) {
            if( $request->get('type') == 'comment' ) {
                $ticket        = TicketComment::findOrNew( $request->get('comment_id') );
            }

            $arrResult['html']                  = $ticket->description;
            $arrResult['html_replaced']         = $ticket->getParsedDescription();
        }

        return $arrResult;
    }


}
