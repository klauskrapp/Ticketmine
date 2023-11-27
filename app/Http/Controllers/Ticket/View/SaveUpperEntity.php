<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class SaveUpperEntity extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Saves upper entitiy
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
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
            $field      = $request->get('db_field');
            $value      = $request->get('new_value');
            $model      = $request->get('model');

            $oldValue   = $ticket->$field;


            $ticket->$field     = $value;
            $ticket->save();

            \App\Helpers\Ticket::addNmRelation( $ticket->id, array(\auth()->user()->id ), false, 'user_follows_ticket' );

            if( $oldValue != $value ) {
                $arrResult['do_change']     = true;

                $before                     = $model::find( $oldValue );
                $after                      = $model::find( $value );
                $arrConfig			        = config('ticket.' . $request->get('config_key'));
                $ticket				        = Ticket::find( $ticket->id );

                $arrSettings				= array();
                $arrSettings['who']			= \auth()->user()->name;
                $arrSettings['didwhat']		= __($arrConfig['didwhat']);
                $arrSettings['didwhat']		= str_replace( array('{from}', '{to}'), array( $before->name, $after->name ), $arrSettings['didwhat'] );
                $arrSettings['content']		= '';
                $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
                $arrSettings['ticket']		= $ticket;


                $cReceiver					= Email::getEmailReceiver( $ticket, $request->get('config_key') );
                $follower					= Email::getReceivers( $cReceiver );

                Email::sendFinalMail($arrConfig, $arrSettings, $follower);

                $mView = View::make('ticket.view.details_persons.span', array(
                    'entity'    => $after
                ));
                $arrResult['html']      =(string)$mView;
            }
        }

        return $arrResult;
    }


}
