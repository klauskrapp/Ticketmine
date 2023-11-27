<?php

namespace App\Http\Controllers\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Attribute
{

    /**
     *
     * Deletes an attribute
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Attribute $attribute
     * @return array $result
     *
     */
    public function execute(Request $request, \App\Models\Attribute $attribute ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $attribute ) {
            $attribute->delete();
        }

        return $result;
    }


}
