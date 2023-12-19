<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\Attribute;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Getattribute extends \App\Http\Controllers\Ticket\View\View
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
    public function execute(Request $request, Ticket $ticket, Attribute $attribute ):array {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $ticket->id);


        $arrResult      = array(
            'html'      => '',
            'attribute'      => '',
        );

        if( $ticket ) {
            $ticket->addAttributes();
            $mView = View::make('ticket.view.details_attributes.attribute', array(
                'entity'        => $ticket,
                'attribute'     => $attribute
            ));
            $arrResult['html']      = (string)$mView;
            $arrResult['attribute']      = $attribute;
        }


        return $arrResult;
    }


}
