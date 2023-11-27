<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\DashboardElement;
use App\Models\Filter;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Fetchfilterlist extends Dashboard
{

    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     *
     */
    public function execute(Request $request, DashboardElement $dashboardelement, Filter $filter )
    {

        $arrResult['totals']		= 0;
        $arrResult['pages']			= 1;
        $arrResult['current']		= 1;
        $arrResult['html']			= '';


        $dashboard          = $dashboardelement->dashboard;
        if( $dashboard->user_id == auth()->user()->id && $filter->user_id == auth()->user()->id ) {

            $filters        = $filter->querystring;
            if( substr( $filters , 0, 1) == '?' ) {
                $filters	= substr( $filters, 1, -1 );
            }
            $s 				= parse_url(  $filters );
            parse_str( $s['path'], $options );
            if( is_array($options) == false ) {
                $options            = array();
            }


            $filter         = new \App\Helpers\Filter();
            $search         = new \App\Helpers\Search();
            $search->setParams( $options );
            $search->setProjectIds( auth()->user()->visibleprojects->pluck('id')->toArray() );
            $search->execute();
            $ids            = array_unique( $search->getIds() );


            $arrItems					= $filter->slice( $ids,  $request->get('start', 1 ),  $request->get('limit', 7 ) );
            $rows                       = array();
            if( empty( $ids ) == false ) {
                $rows = Ticket::with(array('project', 'state', 'action', 'creator', 'assigned'))
                    ->whereIn('id', $arrItems)
                    ->orderByRaw('FIELD(id, ' . implode(',', $arrItems) . ')')->get();
            }



            $mView	= View::make( 'dashboard.type.filterlist.fetchall', array(
                'rows'      => $rows
            ) );



            // JSON response
            $arrResult['totals']		= count( $ids );
            $arrResult['pages']			= ceil( count( $ids ) / $request->get('limit', 7 ) );
            $arrResult['current']		= $request->get('start', 1 );
            $arrResult['html']			= (string)$mView;
        }

        return $arrResult;
    }


}
