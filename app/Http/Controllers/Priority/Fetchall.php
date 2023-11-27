<?php

namespace App\Http\Controllers\Priority;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Fetchall extends Priority
{

    /**
     * Load data for listview via ajax
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return array $arrResult
     *
     */
    public function execute(Request $request):array
    {
        // set default query
        $sql    = 'SELECT priority.*, project.name as project_name FROM priority LEFT JOIN project on project.id = priority.project_id';
        $filter = new Filter();



        // default order
        $orderQuery					= $filter->getOrderBy( $request->get('sorting'), ' ORDER BY priority.id DESC, project_id DESC' );
        // add the filters and build the query statement
        $arrSql						= $filter->getStatement( $sql, json_decode($request->get('__filters' ) ), $orderQuery );
        // execute the statement with the bindings
        $rows						= DB::select(  $arrSql['sql'], $arrSql['bindings']  );
        // slice the outout
        $rows						= index_by( $rows, 'id' );
        $arrItems					= $filter->slice( $rows,  $request->get('start', 1 ),  $request->get('limit', 20 ) );



        $mView	= View::make( 'priority.fetchall', array(
            'rows'      => $arrItems
        ) );



        // JSON response
        $arrResult['totals']		= count( $rows );
        $arrResult['pages']			= ceil( count( $rows ) / $request->get('limit', 20 ) );
        $arrResult['current']		= $request->get('start', 1 );
        $arrResult['html']			= (string)$mView;


        return $arrResult;
    }


}
