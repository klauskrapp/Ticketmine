<?php

namespace App\Http\Controllers\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Manage
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Dashboard $dashboard
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\Dashboard $dashboard ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $dashboard && $dashboard->user_id == auth()->user()->id ) {
            $dashboard->delete();
        }

        return $result;
    }


}
