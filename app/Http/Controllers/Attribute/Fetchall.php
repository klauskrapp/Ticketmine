<?php

namespace App\Http\Controllers\Attribute;
use App\Helpers\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Fetchall extends Attribute
{

    /**
     * Load data for listview via ajax
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @return array $arrResult
     */
    public function execute(Request $request): array
    {
        // set default query
        $sql    = 'Select attribute.*, a.name as attribute_type_name FROM attribute
                   LEFT JOIN attribute_type a on attribute.attribute_type_id = a.id';
        $filter = new Filter();

        // default order
        $orderQuery					= $filter->getOrderBy( $request->get('sorting'), ' ORDER BY attribute.id DESC' );
        // add the filters and build the query statement
        $arrSql						= $filter->getStatement( $sql, json_decode($request->get('__filters' ) ), $orderQuery );
        // execute the statement with the bindings
        $rows						= DB::select(  $arrSql['sql'], $arrSql['bindings']  );
        // slice the outout
        $rows						= index_by( $rows, 'id' );
        $arrItems					= $filter->slice( $rows,  $request->get('start', 1 ),  $request->get('limit', 20 ) );



        $mView	= View::make( 'attribute.fetchall', array(
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
