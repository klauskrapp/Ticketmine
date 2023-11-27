<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\DashboardElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Activitystream extends Dashboard
{

    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     *
     */
    public function execute(Request $request, DashboardElement $dashboardelement)
    {
        $html               = '';
        $dashboard          = $dashboardelement->dashboard;
        if( $dashboard->user_id == auth()->user()->id ) {
            $projectIds     = auth()->user()->visibleprojects->pluck('id')->toArray();

            $offset         = $request->get('current', 0 );
            $limit         = $request->get('limit', 7 );

            $activities		= \App\Models\Activitystream::with(array( 'user', 'ticket' ) )
                ->whereIn('project_id', $projectIds )
                ->skip($offset*$limit)->take($limit)
                ->orderBy('created_at', 'DESC')->get();


            $mView = view( 'dashboard.type.activitystream.item', array(
                'elements'  => $activities
            ) );

            $html       = (string)$mView;
        }

        return response( $html );
    }


}
