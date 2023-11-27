<?php

namespace App\Http\Controllers\Ticket\View;
use App\Helpers\Email;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class Uploadattachment extends \App\Http\Controllers\Ticket\View\View
{


    /**
     *
     * Upload an attaschment
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse $result
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $ticket         = $this->getTicket( auth()->user()->visibleprojects->pluck('id')->toArray(), 'id', $request->get('ticket_id') );
        if( $ticket ) {

            $file = $request->file('attachment');
            if( is_object( $file ) == true && $file->getError() == 0 && $file->getClientOriginalName() != '') {
                $filename		= md5( session_id() . time() . '_' . hash('sha1', uniqid()) );
                $path           = $this->getStoragePath( $ticket, $filename );
                if( is_dir( $path ) == false ) {
                    mkdir( $path, 0777, true );
                }
                $newPath        = $path . $filename;

                $ticket->touch();

                $attachment     = new TicketAttachment();
                $attachment->ticket_id      = $ticket->id;
                $attachment->name           = $file->getClientOriginalName();
                $attachment->mime           = $file->getMimeType();
                $attachment->hash           = $filename;
                $attachment->save();
                move_uploaded_file( $file->getPathname(), $newPath  );



                $arrConfig			        = config('ticket.attachment_added');

                $arrSettings				= array();
                $arrSettings['who']			= \auth()->user()->name;
                $arrSettings['didwhat']		= __( $arrConfig['didwhat']);
                $arrSettings['content']		= '';
                $arrSettings['subject']		= Email::getSubject( __($arrConfig['subject']), $ticket );
                $arrSettings['ticket']		= $ticket;


                $cReceiver					= Email::getEmailReceiver( $ticket, 'attachment_added' );
                $follower					= Email::getReceivers( $cReceiver );

                Email::sendFinalMail($arrConfig, $arrSettings, $follower);

            }


            $arrResult                      = array();
            $arrResult['message_type']      = 'success';
            $arrResult['message']           = __('global.entity_saved');
            $arrResult['move_to']           = url('browse/' . $ticket->unique_id  );


            $request->session()->flash('message',  $arrResult );
            return redirect( $arrResult['move_to'] );

        }

        $arrResult['move_to']           = url('search');
        return redirect( $arrResult['move_to'] );
    }


}
