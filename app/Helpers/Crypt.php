<?php

namespace App\Helpers;

class Crypt {


    /**
     * Generates a users hash-password
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param $password, users password
     * @param $unique_id, area string
     *
     * @return string $hash, crypted password
     */
    public static function generateUserPassword( $password, $unique_id ):string {
        $hash		= $password . '-' . $unique_id;
        $hash		= md5( $hash );
        return $hash;
    }


}
