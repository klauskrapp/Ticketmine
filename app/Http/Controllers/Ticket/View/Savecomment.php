<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Editor;
use App\Helpers\Email;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Savecomment extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Savees a comment
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  array $result
     *
     *
     */
    public function execute(Request $request ):array {
        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );

        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_saved')
        );
        if( $ticket ) {
            if( $request->get('type') == 'description') {
                $ticket->description = $request->get('content');
                $ticket->save();
                $result['html']              = $ticket->description;
                $this->sendNotificationmail( $ticket, $request->get('config_key'));
                $this->sendNoticedEmail( $ticket, $ticket->description );
                $desc                       = __('dashboard.changed_description_to')  . ': '. $ticket->description;
                $loadedTicket               = clone $ticket;
            }
            else if( $request->get('type') == 'comment' ) {
                $loadedTicket               = clone $ticket;
                $ticket                     = TicketComment::findOrNew( $request->get('comment_id') );
                $ticket->ticket_id          = $request->get('ticket_id');
                $ticket->description        = $request->get('content');
                $ticket->created_by         = \auth()->user()->id;
                $desc                       = __('dashboard.created_new_comment') . ': ' .  $ticket->description;
                if( $request->get('comment_id') != '' ) {
                    $ticket->updated_by      = \auth()->user()->id;
                    $desc                       = __('dashboard.changed_comment_to') . ': ' . $ticket->description;
                }
                $config                     = $request->get('comment_id') == '' ? 'new_comment_added' : 'comment_edit';
                $ticket->save();
                $this->sendNotificationmail( $ticket, $config);
                $this->sendNoticedEmail( $loadedTicket, $ticket->description );

            }

            \App\Helpers\Ticket::toActivityStream( $loadedTicket->id, auth()->user()->id, $loadedTicket->project_id, 'state_changed', $desc );
        }

        return $result;
    }


    protected function sendNoticedEmail( $ticket, $content ) {
        $users          = Editor::getUsersInText( $content );
        if( empty( $users ) == false ) {
            $uniqueIds  = array_keys( $users );
            $usersFound = User::whereIn('unique_id', $uniqueIds)->get();
            $toSend     = array();
            foreach( $usersFound as $user ) {
                if( $user->getSetting('comment_mention') == 1 ) {
                    $toSend[ $user->id ]       = $user;
                }
            }
            if( empty($toSend ) == false ) {
                $arrConfig			        = config('ticket.comment_mention');
                $arrSettings				= array();
                $arrSettings['who']			= \auth()->user()->name;
                $arrSettings['didwhat']		= __( $arrConfig['didwhat']);
                $arrSettings['content']		= '';
                $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
                $arrSettings['ticket']		= $ticket;

                $follower					= Email::getReceivers( $toSend );
                Email::sendFinalMail($arrConfig, $arrSettings, $follower);
            }
        }
    }



    protected function sendNotificationmail( $ticket, $config ) {
        $arrConfig			        = config('ticket.' . $config);

        $arrSettings				= array();
        $arrSettings['who']			= \auth()->user()->name;
        $arrSettings['didwhat']		= __( $arrConfig['didwhat']);
        $arrSettings['content']		= '';
        $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
        $arrSettings['ticket']		= $ticket;


        $cReceiver					= Email::getEmailReceiver( $ticket, $config );
        $follower					= Email::getReceivers( $cReceiver );

        Email::sendFinalMail($arrConfig, $arrSettings, $follower);
    }
}
