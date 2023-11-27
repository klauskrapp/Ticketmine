<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class ActionOrPriority extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Save Action Or Priority
     *
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return  string $mView;

     */
    public function execute(Request $request ):string {

        $model  = $request->get('model');

        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );

        if( $ticket ) {

            $entities       = $model::where('project_id', '=', $ticket->project_id)->orderBy('position', 'asc')->get();

            $mView = View::make('ticket.view.details_persons.select_left', array(
                'ticket'        => $ticket,
                'entities'      => $entities,
                'current_value' => $request->get('current_value')
            ));
            return $mView;
        }
        return '';

    }


}
