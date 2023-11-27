<?php
namespace App\Helpers;
class Editor

{


    /**
     * Replace URL, created by the tiny
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param string $content, content of tinymce
     * @return string $content
     *
     */
    public static function replaceAppUrl( $content ):string|null {
        if( $content ) {
            $content        = str_replace( '{{app_url}}', url(''), $content );
        }
        return $content;
    }


    /**
     * Get the users, written in a comment
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param string $content, content of tinymce
     * @return array $users, unique_id of the users
     *
     */
    public static function getUsersInText( $content ):array {
        preg_match('/\[u\:([^\]]*)\]/', $content, $matches );
        $arrFound       = array();
        if( is_array( $matches ) == true && empty( $matches ) == false ) {
            foreach( $matches as $match ) {
                if( substr( $match, 0, 1 ) == '[') {
                    $arrFound[]     = $match;
                }
            }
        }

        $users      = array();
        foreach( $arrFound as $item ) {
            $arrSnippets       = explode('data-item-user-id="', $item );
            if( isset( $arrSnippets[1]) == true ) {

                $arrSnippets        = explode('"', $arrSnippets[1] );
                if( isset( $arrSnippets[0] ) ) {
                    $users[ $arrSnippets[0] ] = $item;
                }
            }
        }
        return $users;
    }



    /**
     * Replace content with the users
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param string $content, content of tinymce
     * @return string $content
     *
     */
    public static function replaceUsers( $content ):string|null {
        $arrUsers       = self::getUsersInText( $content );

        if( empty( $arrUsers ) == false ) {
            $arrUniqueIds       = array_keys( $arrUsers );
            $cUsers             = \App\Models\User::whereIn('unique_id', $arrUniqueIds )->get();
            $cUsers             = index_by( $cUsers, 'unique_id' );
            foreach( $arrUsers as $unique_id => $user ) {
                if( isset( $cUsers[ $unique_id ] ) == true ) {
                    $span       = '<span style="color:#3399FF;">' . $cUsers[ $unique_id ]->name . '</span>';
                    $content = str_replace($user, $span, $content );
                }
            }
        }
        return $content;
    }
}


