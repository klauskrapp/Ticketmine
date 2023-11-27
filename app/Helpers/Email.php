<?php
namespace App\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;

class Email
{


    /**
     * @var bool
     */
    public static $_removeUserId = true;


    /**
     * Get emails subject
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param string $subject
     * @param \App\Models\Ticket $ticket
     *
     * @return string $subject
     */
    public static function getSubject( $subject, \App\Models\Ticket $ticket ):String {

        if( config( 'mail.subject_prefix' ) != '' ) {
            $subject = config( 'mail.subject_prefix' ) . ' ' . $subject;
        }
        $subject = str_replace( array( '{unique_id}', '{name}' ), array( $ticket->unique_id, $ticket->name ), $subject );

        return $subject;
    }



    /**
     * Get receivers of the mail
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\Ticket $ticket
     * @param String $action
     *
     * @return Collection $cReceiver
     */
    public static function getEmailReceiver( \App\Models\Ticket $ticket, $action ):Collection {

        $followers = $ticket->follower;
        $creator   = $ticket->creator;
        $assigned  = $ticket->assigned;


        $arrReceivers = array();


        foreach( $followers as $follower ) {
            $canReceiveMail = self::checkMailSettings( $follower, $action, User::follower );
            if( $canReceiveMail == true ) {
                $arrReceivers[ $follower->email ] = $follower;
            }
        }


        foreach( $assigned as $follower ) {
            $canReceiveMail = self::checkMailSettings( $follower, $action, User::assigned );
            if( $canReceiveMail == true ) {
                $arrReceivers[ $follower->email ] = $follower;
            }
        }


        $canReceiveMail = self::checkMailSettings( $creator, $action, User::author );
        if( $canReceiveMail == true ) {
            $arrReceivers[ $creator->email ] = $creator;
        }


        $cReceiver = collect( array_values( $arrReceivers ) );

        return $cReceiver;
    }




    /**
     * Get the receivers of the mail, depending on the system
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $arrReceivers
     * @return array $arrReceivers
     */
    public static function getReceivers( $arrReceivers ):array {

        $system = config( 'app.env' );

        // live or production
        if( $system == 'live' || $system == 'production' ) {
            $arrReceivers = $arrReceivers->keyBy( 'email' );
            // if true, remove logged In user that no info is send
            if( self::$_removeUserId == true ) {
                $arrReceivers = $arrReceivers->reject( function( $value, $key ) {
                    return $value->id == \Auth::user()->id;
                });
            }
        }
        else {
            //	in dev mode
            $arrReceiverMails = config( 'mail.debug_receiver' );
            $arrReceivers     = array();
            foreach( $arrReceiverMails as $receiver ) {
                $stdClass                  = new \stdClass();
                $stdClass->email           = $receiver;
                $stdClass->name            = 'debug receiver';
                $arrReceivers[ $receiver ] = $stdClass;
            }
        }
        return $arrReceivers;
    }



    /**
     * Check bitflag if user can receive email
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\User $user
     * @param string $action, emailaction
     * @param int $type, bitflag value
     *
     * @return bool $blnReceiveMail
     */
    public static function checkMailSettings( $user, $action, $type ):bool {



        $blnReceiveMail = false;
        $arrOptions     = [];
        $setting       = $user->getSetting( $action );

        if( $setting ) {
            $bitFlag        = $setting;
            $arrMailOptions = User::getMailOptions();
            foreach( $arrMailOptions as $option => $label ) {
                $flag = User::checkBitFlag( $bitFlag, $option );
                if( $flag == true ) {
                    $arrOptions[ $option ] = $option;
                }
            }

            if( isset( $arrOptions[ $type ] ) == true ) {
                $blnReceiveMail = true;
            }

        }

        return $blnReceiveMail;
    }




    /**
     * Send the mail
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param array $arrConfig, item from the config
     * @param array $arrSettings, settings for sending
     * @param Collection $cFollower, receivers
     */
    public static function sendFinalMail( $arrConfig, $arrSettings, $cFollower ):void {

        if( ( is_array( $cFollower ) == true && empty( $cFollower ) == false ) || $cFollower->isEmpty() == false ) {
            try {
                Mail::send( $arrConfig[ 'template' ], $arrSettings, function( $message ) use ( $cFollower, $arrSettings ) {
                    foreach( $cFollower as $follower ) {
                        $message->bcc( $follower->email, $follower->name );
                        $message->subject( $arrSettings[ 'subject' ] );
                    }
                }
                );
            }
            catch ( TransportException $e){
                dd( $e );
            }
        }
    }
}


