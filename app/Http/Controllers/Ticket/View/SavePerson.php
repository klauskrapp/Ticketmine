<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class SavePerson extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Saves a person
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  array $result
     *
     */
    public function execute(Request $request ):array {

        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );
        $arrResult      = array(
            'do_change'         => false,
            'html'              => ''
        );
        if( $ticket ) {
            $value      = $request->get('new_value');
            $value      = is_array( $value ) == false ? explode(',', $value ) : $value;
            $ticket->touch();
            $follower   = $ticket->follower;
            $author     = $ticket->creator;
            $assigned   = $ticket->assigned;

            $from       = array();
            if( $request->get('type') == 'follower') {
                \App\Helpers\Ticket::addNmRelation( $ticket->id, $value, true, 'user_follows_ticket' );
                if( $follower ) {
                    $from       = $follower->pluck('name')->toArray();
                }
            }
            else if( $request->get('type') == 'assigned' ) {
                \App\Helpers\Ticket::addNmRelation( $ticket->id, $value, true, 'ticket_assigned_to' );
                \App\Helpers\Ticket::addNmRelation( $ticket->id, $value, false, 'user_follows_ticket' );
                if( $assigned ) {
                    $from       = $assigned->pluck('name')->toArray();
                }
            }
            else {
                $ticket->created_by         = $value[0];
                $from[]                       = $author->name;
                $ticket->save();
            }


            $arrResult['do_change']     = true;

            $arrConfig			        = config('ticket.' . $request->get('config_key'));
            $ticket				        = Ticket::find( $ticket->id );

            $follower   = $ticket->follower;
            $author     = $ticket->creator;
            $assigned   = $ticket->assigned;
            $toOutput   = array( $author );

            $to         = array();
            if( $request->get('type') == 'follower') {
                $toOutput       = $follower;
                if( $follower ) {
                    $to       = $follower->pluck('name')->toArray();
                }
            }
            else if( $request->get('type') == 'assigned' ) {
                $toOutput       = $assigned;
                if( $assigned ) {
                    $to       = $assigned->pluck('name')->toArray();
                }
            }
            else {
                $to[]         = $author->name;
            }

            $from                       = implode(',', $from );
            $to                         = implode(',', $to );

            if( $from != $to ) {
                $arrSettings = array();
                $arrSettings['who'] = \auth()->user()->name;
                $arrSettings['didwhat'] = __($arrConfig['didwhat']);
                $arrSettings['didwhat'] = str_replace(array('{from}', '{to}'), array($from, $to), $arrSettings['didwhat']);
                $arrSettings['content'] = '';
                $arrSettings['subject'] = Email::getSubject(__($arrConfig['subject']), $ticket);
                $arrSettings['ticket'] = $ticket;


                $cReceiver = Email::getEmailReceiver($ticket, $request->get('config_key'));
                $follower = Email::getReceivers($cReceiver);


                $desc                       = __('dashboard.' .  $request->get('config_key') );
                $desc		                = str_replace( array('{from}', '{to}'), array( $from, $to ), $desc );

                \App\Helpers\Ticket::toActivityStream( $ticket->id, auth()->user()->id, $ticket->project_id, 'state_changed', $desc );





                Email::sendFinalMail($arrConfig, $arrSettings, $follower);
            }

            foreach( $toOutput as $person ) {
                $person->icon_class     = 'btn-info';
                $mView = View::make('ticket.view.details_persons.span', array(
                    'entity' => $person
                ));
                $arrResult['html']      .=(string)$mView;
            }
        }

        return $arrResult;
    }


}
