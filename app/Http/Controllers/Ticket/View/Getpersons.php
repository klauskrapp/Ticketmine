<?php

namespace App\Http\Controllers\Ticket\View;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Getpersons extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Get Persons to choose
     *
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  string
     */
    public function execute(Request $request ):string {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );

        if( $ticket ) {
            $project = Project::find($ticket->project_id);
            $usersInProject = $project->visibleusers;

            if( $request->get('type') == 'follower') {

            }
            else if( $request->get('type') == 'author') {

            }


            $mView = View::make('ticket.view.details_persons.select_person', array(
                'ticket'        => $ticket,
                'persons'       => $usersInProject,
                'multiple'      => $request->get('multiple'),
                'current_value' => explode(',', $request->get('current_value') )
            ));
            return $mView;
        }

        return '';

    }


}
