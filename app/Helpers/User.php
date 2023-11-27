<?php
namespace App\Helpers;


class User  {

    const assigned	= 1;
    const author	= 2;
    const follower	= 4;


    /**
     * Get the settings for a user
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrReturn
     */
    public static function getSettings():array {
        $dropdown       = array('comment_mention');
        $multi          = array(
            'comment_edit',
            'attachment_added',
            'ticket_created',
            'ticket_deleted',
            'ticket_moved_to_subticket',
            'author_changed',
            'assigned_changed',
            'follower_changed',
            'description_changed',
            'priority_changed',
            'state_changed',
            'attributes_changed',
            'action_changed',
            'attachment_removed',
            'comment_removed'

        );

        $arrColumns     = array(
        'show_column_unique_id',
        'show_column_project',
        'show_column_name',
        'show_column_created_by',
        'show_assigned_to',
        'show_priority',
        'show_state',
        'show_action',
        );



        $arrReturn = array(
            'dropdown'  => $dropdown,
            'multiselect'     => $multi,
            'gridcolumns'       => $arrColumns
        );



        return $arrReturn;
    }


    /**
     * Check bitflag
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param $flag
     * @param $value
     * @return array $arrReturn
     */
    public static function checkBitFlag( $flag, $value ):bool {

        if( ($flag & $value) === $value ) {
            return true;
        }

        else{
            return false;
        }
    }



    /**
     * Get Mail receivers
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrOptions
     */
    public static function getMailOptions():array {

        $arrOptions = array(
            self::assigned 	=> self::assigned,
            self::author		=> self::author,
            self::follower		=>  self::follower
        );

        return $arrOptions;
    }
}

