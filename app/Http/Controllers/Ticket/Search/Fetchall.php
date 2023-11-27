<?php

namespace App\Http\Controllers\Ticket\Search;



use App\Helpers\Filter;
use App\Http\Controllers\Ticket\Search\Search;
use App\Models\Action;
use App\Models\Priority;
use App\Models\State;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Fetchall extends Search
{




    public function __construct()
    {
        parent::__construct();
    }



    /**
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return array $arrResult
     */
    public function execute(Request $request):array
    {

        $filters        = json_decode( $request->get('grid_filters', '[]') );
        $filters        = json_decode(json_encode($filters), true);
        $filter         = new Filter();
        $search         = new \App\Helpers\Search();
        $search->setParams( $filters );
        $search->setProjectIds( auth()->user()->visibleprojects->pluck('id')->toArray() );
        $search->execute();
        $ids            = array_unique( $search->getIds() );

        $arrItems					= $filter->slice( $ids,  $request->get('start', 1 ),  $request->get('limit', 50 ) );
        $rows                       = array();
        if( empty( $ids ) == false ) {
            $rows = Ticket::with(array('project', 'state', 'action', 'creator', 'assigned'))
                ->whereIn('id', $arrItems)
                ->orderByRaw('FIELD(id, ' . implode(',', $arrItems) . ')')->get();
        }



        $mView	= View::make( 'ticket.search.fetchall', array(
            'rows'      => $rows
        ) );



        // JSON response
        $arrResult['totals']		= count( $ids );
        $arrResult['pages']			= ceil( count( $ids ) / $request->get('limit', 50 ) );
        $arrResult['current']		= $request->get('start', 1 );
        $arrResult['html']			= (string)$mView;


        return $arrResult;


    }


}
