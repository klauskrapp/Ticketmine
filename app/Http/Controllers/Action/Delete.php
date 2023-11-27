<?php

namespace App\Http\Controllers\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Action
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Action $action
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\Action $action ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $action ) {
            $action->delete();
        }

        return $result;
    }


}
