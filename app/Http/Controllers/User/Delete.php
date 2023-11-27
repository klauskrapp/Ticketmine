<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends User
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\User $user
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\User $user ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $user ) {
            $user->delete();
        }

        return $result;
    }


}
