<?php

namespace App\Http\Controllers\Manage\Configure;
use App\Helpers\Filter;
use App\Http\Controllers\Priority\Priority;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Fetchall extends Configure
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
    public function execute(Request $request, Dashboard $dashboard ):array
    {
        $rows               = array();
        $mView              = '';
        if( $dashboard->user_id == auth()->user()->id ) {


            // set default query
            $sql = 'SELECT dashboard_element.* FROM dashboard_element';
            $filter = new Filter();


            $filters            = json_decode($request->get('__filters', '[]') );
            $std                = new \stdClass();
            $std->table         = 'dashboard_element';
            $std->field         = 'dashboard_id';
            $std->value         = $dashboard->id;
            $std->operator      = 'equalsorlike';
            $filters[]          = $std;

            // default order
            $orderQuery = $filter->getOrderBy($request->get('sorting'), ' ORDER BY dashboard_element.id DESC');
            // add the filters and build the query statement
            $arrSql = $filter->getStatement($sql, $filters, $orderQuery);
            // execute the statement with the bindings
            $rows = DB::select($arrSql['sql'], $arrSql['bindings']);
            // slice the outout
            $rows = index_by($rows, 'id');
            $arrItems = $filter->slice($rows, $request->get('start', 1), $request->get('limit', 20));


            $mView = View::make('manage.configure.tab.fetchall', array(
                'rows' => $arrItems,
                'entity'    => $dashboard
            ));


        }

        // JSON response
        $arrResult['totals']		= count( $rows );
        $arrResult['pages']			= ceil( count( $rows ) / $request->get('limit', 20 ) );
        $arrResult['current']		= $request->get('start', 1 );
        $arrResult['html']			= (string)$mView;


        return $arrResult;
    }


}
