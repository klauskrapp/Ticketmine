<?php
namespace App\Helpers;


class Grid  {

    public static $currentState         = 'even';


    /**
     * CSS Class for table
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return string
     */
    public static function getEvenOrOdd():string {
        $return             = 'even';
        if( self::$currentState == 'even' ) {
            self::$currentState     = 'odd';
            $return         = 'odd';
        }

        return $return;
    }

}
