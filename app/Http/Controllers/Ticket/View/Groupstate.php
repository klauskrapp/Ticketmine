<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\State;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Groupstate extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Get Groupstates
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  array $result
     *
     */
    public function execute(Request $request ):string {

        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );

        if( $ticket ) {

            $rows = \DB::table('state_chain')
                ->join('state', 'state_chain.from', '=', 'state.id')
                ->where('state_chain.from', '=', $request->get('current_value'))->orderBy('position', 'asc')
                ->where('project_id', '=', $ticket->project_id)->get();

            $ids        = get_ids( $rows, 'to' );
            $entities   = array();
            if( empty( $ids ) == false ) {
                $entities   = State::whereIn('id', $ids )->orderBy('position', 'asc')->get();
            }


            $mView = View::make('ticket.view.details_persons.select_left', array(
                'ticket' => $ticket,
                'entities' => $entities,
                'current_value' => $request->get('current_value')
            ));
            return $mView;
        }

        return '';
    }


}
