<?php

namespace App\Http\Controllers\Manage\Configure;
use App\Http\Controllers\Manage\Manage;
use App\Models\DashboardElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Configure
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

     *
     *
     */
    public function execute(Request $request, \App\Models\Dashboard $dashboard, DashboardElement $dashboardelement ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $dashboard && $dashboard->user_id == auth()->user()->id && $dashboardelement ) {
            $dashboardelement->delete();
        }

        return $result;
    }


}
