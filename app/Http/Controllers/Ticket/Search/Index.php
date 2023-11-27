<?php

namespace App\Http\Controllers\Ticket\Search;




use App\Models\Action;
use App\Models\Filter;
use App\Models\Priority;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class Index extends Search
{




    public function __construct()
    {
        parent::__construct();
    }



    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function execute(Request $request):\Illuminate\View\View
    {
        $action = Action::with('project')->orderBy('project_id', 'asc')->orderBy('position', 'asc')->get();
        $prio   = Priority::with('project')->orderBy('project_id', 'asc')->orderBy('position', 'asc')->get();
        $state  = State::with('project')->orderBy('project_id', 'asc')->orderBy('position', 'asc')->get();


        $action = $this->groupByProject( $action );
        $prio = $this->groupByProject( $prio );
        $state = $this->groupByProject( $state );

        $filters    = partition( index_by( auth()->user()->filters , 'id' ), 2 );


        $mView	= View::make( 'ticket.search.index', array(
            'users'      => \App\Models\User::where('is_active', '=', 1 )->get(),
            'action'     => $action,
            'priority'      => $prio,
            'state'     => $state,
            'filters'   => $filters
        ));
        return $mView;
    }



    /**
     * Group prio or state by the project
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $data
     * @return array $arrResult
     */
    protected function groupByProject(  Collection $data ):array {

        $arrResult      = array();
        foreach( $data as $item ) {
            if( isset( $arrResult[ $item->project_id ]) == false ) {
                $arrResult[ $item->project_id ]['project']      =    $item->project;
                $arrResult[ $item->project_id ]['children']     =    array();
            }
            $arrResult[ $item->project_id ]['children'][]       = $item;
        }
        return $arrResult;
    }
}
