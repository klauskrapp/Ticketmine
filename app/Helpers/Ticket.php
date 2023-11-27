<?php
namespace App\Helpers;


use App\Models\Activitystream;

class Ticket  {


    /**
     * Add an N:M relation
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param $ticketId, ID of the ticket
     * @param $relatedUsers, array of user ids to add
     * @param $removeExisting, if true, clear the relation table
     * @param $table, name of the relation table
     * @return void
     */
    public static function addNmRelation( $ticketId, $relatedUsers, $removeExisting, $table ):void {
        if( $removeExisting == true ) {
            \DB::table( $table )->where('ticket_id', '=', $ticketId)->delete();
        }

        $arrItems           = array();
        foreach( $relatedUsers as $item ) {
            if( $item != '' ) {
                $arrItems[$item] = $item;
            }
        }


        if( is_array( $arrItems ) == true && empty( $arrItems ) == false ) {
            foreach( $arrItems as $userId ) {
                $sql        = 'REPLACE INTO '.$table.' (ticket_id, user_id ) VALUES ('.$ticketId.', '.$userId .')';
                \DB::insert( $sql );
            }
        }
    }




    /**
     * Add to activity stram
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param int $ticket_id, ID of the ticket
     * @param int $user_id, ID of the user
     * @param int $project_id, ID of the project
     * @param String $template, config value for the template
     * @param String $content, content of the stram
     *
     * @return Activitystream $stream
     */
    public static function toActivityStream( $ticket_id, $user_id, $project_id, $template, $content ) {
        $stream		= new Activitystream();
        $stream->ticket_id		= $ticket_id;
        $stream->user_id		= $user_id;
        $stream->project_id		= $project_id;
        $stream->template		= $template;
        $stream->content		= $content;
        $stream->save();

        return $stream;
    }
}

