<?php

namespace App\Http\Controllers\Manage;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Fetchall extends Manage
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
        $sql    = 'SELECT dashboard.* FROM dashboard';
        $filter = new Filter();

        $filters        = json_decode($request->get('__filters', '[]') );


        $std            = new \stdClass();
        $std->table         = 'dashboard';
        $std->field         = 'user_id';
        $std->value         = auth()->user()->id;
        $std->operator      = 'equalsorlike';

        $filters[]          = $std;

        // default order
        $orderQuery					= $filter->getOrderBy( $request->get('sorting'), ' ORDER BY dashboard.id DESC' );
        // add the filters and build the query statement
        $arrSql						= $filter->getStatement( $sql, $filters , $orderQuery );
        // execute the statement with the bindings
        $rows						= DB::select(  $arrSql['sql'], $arrSql['bindings']  );
        // slice the outout
        $rows						= index_by( $rows, 'id' );
        $arrItems					= $filter->slice( $rows,  $request->get('start', 1 ),  $request->get('limit', 20 ) );



        $mView	= View::make( 'manage.fetchall', array(
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
