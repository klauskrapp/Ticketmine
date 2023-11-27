<?php

namespace App\Http\Controllers\Groupstate;
use Illuminate\Http\Request;


class Delete extends Groupstate
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\State $state
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\State $state ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $state ) {
            $state->delete();
        }

        return $result;
    }


}
