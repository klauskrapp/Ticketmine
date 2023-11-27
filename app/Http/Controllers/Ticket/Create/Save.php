<?php

namespace App\Http\Controllers\Ticket\Create;
use App\Helpers\Attribute;
use App\Helpers\Editor;
use App\Helpers\Email;
use App\Http\Controllers\Project\Project;
use App\Jobs\TicketIndex;
use App\Jobs\TicketIndexJob;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Save extends Create
{


    /**
     *
     * Saves a ticket
     *
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return  Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {
        $data           = $request->get('ticket');
        $attributes     = $request->get('attribute', array() );


        $project    = \App\Models\Project::find( $data['project_id'] );
        $data       = array_merge( $data, $this->getIncrementId( $project ) );
        $ticket     = new Ticket();
        $ticket->addData( $data );
        $ticket->save();
        Attribute::saveAttributes( $ticket->id, $attributes );




        $arrFollower        = $request->get('follower', array() );
        $arrFollower[]      = $request->get('created_by');
        $arrFollower        = array_unique( $arrFollower );
        \App\Helpers\Ticket::addNmRelation( $ticket->id, $arrFollower, true, 'user_follows_ticket' );
        \App\Helpers\Ticket::addNmRelation( $ticket->id, $request->get('assigned_to', array() ), true, 'ticket_assigned_to' );


        \App\Helpers\Ticket::toActivityStream( $ticket->id, $ticket->created_by, $ticket->project_id, 'ticket_created', $ticket->description );
        $this->sendCreationEmail( $ticket );

        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = $ticket->getUrl();

        \Queue::later(30, new TicketIndex( $ticket->id ) );

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
    protected function sendCreationEmail( $ticket ) {
        $arrConfig			        = config('ticket.new_ticket_created');
        $ticket				        = Ticket::find( $ticket->id );

        $creator					= User::find( $ticket->created_by );
        $arrSettings				= array();
        $arrSettings['who']			= $creator->name;
        $arrSettings['didwhat']		= __($arrConfig['didwhat']);
        $arrSettings['content']		= Editor::replaceAppUrl( $ticket->description );
        $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
        $arrSettings['ticket']		= $ticket;


        $cReceiver					= Email::getEmailReceiver( $ticket, 'ticket_created' );
        $follower					= Email::getReceivers( $cReceiver );

        Email::sendFinalMail($arrConfig, $arrSettings, $follower);
    }




    /**
     *
     * Get the next ticket ID
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\Project $project
     *
     * @return  array $result, with unique Ticket ID and the increment ID
     */
    protected function getIncrementId($project) {

        $strUniqueId	= $project->unique_id;

        $project->increment('increment_id');
        $strUniqueId .= '-' .  $project->increment_id++;
        $project->save();

        $arrResult		= array(
            'unique_id'	=> $strUniqueId,
            'increment_id' => $project->increment_id
        );
        return $arrResult;

    }

}
