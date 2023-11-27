<?php

namespace App\Http\Controllers\User;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Fetchall extends User
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
        $sql    = 'SELECT user.* FROM user';
        $filter = new Filter();



        // default order
        $orderQuery					= $filter->getOrderBy( $request->get('sorting'), ' ORDER BY user.id DESC' );
        // add the filters and build the query statement
        $arrSql						= $filter->getStatement( $sql, json_decode($request->get('__filters' ) ), $orderQuery );
        // execute the statement with the bindings
        $rows						= DB::select(  $arrSql['sql'], $arrSql['bindings']  );
        // slice the outout
        $rows						= index_by( $rows, 'id' );
        $arrItems					= $filter->slice( $rows,  $request->get('start', 1 ),  $request->get('limit', 20 ) );



        $mView	= View::make( 'user.fetchall', array(
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
