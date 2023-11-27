<?php

namespace App\Http\Controllers\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Priority
{

    /**
     *
     * Deletes an entry
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Priority $priority
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\Priority $priority ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $priority ) {
            $priority->delete();
        }

        return $result;
    }


}
