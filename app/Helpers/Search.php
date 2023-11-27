<?php
namespace App\Helpers;


use App\Models\Activitystream;
use App\Models\StateHasStateGroup;

class Search  {

    /**
     * @var array
     */
    protected $params           = array();

    /**
     * @var array
     */
    protected $ticketIds        = array();

    /**
     * @var null
     */
    protected $projectIds       = null;

    /**
     * Set Searchparams as array
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $arrData
     * @return void
     */
    public function setParams( array $arrData ):void {
        $this->params           = $arrData;
    }



    /**
     * Execute the search
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return void
     */
    public function execute() {
        if( is_array( $this->projectIds ) == true && empty( $this->projectIds ) == false ) {
            $arrFilterResult = $this->getIdsWithFiltering();
            $arrAttributeResult = $this->getIdsWithAttributeFiltering();
            $arrFulltextResult = $this->getIdsFromFulltext();

            if ($arrFilterResult['filtered'] == true || $arrFulltextResult['filtered'] == true || $arrAttributeResult['filtered'] == true) {
                $arrFilterableIds = array();
                $arrFilterResult['filtered'] == true ? $arrFilterableIds[] = $arrFilterResult['ids'] : '';
                $arrFulltextResult['filtered'] == true ? $arrFilterableIds[] = $arrFulltextResult['ids'] : '';
                $arrAttributeResult['filtered'] == true ? $arrFilterableIds[] = $arrAttributeResult['ids'] : '';


                $arrIds = $arrFilterableIds[0];
                if (count($arrFilterableIds) > 1) {
                    $arrIds = call_user_func_array('array_intersect', $arrFilterableIds);
                    $sql = 'SELECT id FROM ticket WHERE id IN(' . implode(',', $arrIds) . ') order by updated_at desc LIMIT ' . config('app.max_tickets');
                    $arrData = \DB::select($sql);
                    $arrData = get_ids($arrData, 'id');
                }
            } else {
                $arrIds = $this->getIdsWithoutFiltering();
            }
        }
        else {
            $arrIds             = array();
        }

        $this->ticketIds        = $arrIds;
    }



    /**
     * Set project Ids, the user is allowed to search
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return void
     */
    public function setProjectIds( array $projectIds ):void {
        $this->projectIds           = $projectIds;
    }



    /**
     * Get the ids of the tickets found
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array
     */
    public function getIds():array {
        return $this->ticketIds;
    }


    /**
     * Case if no filter is set
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrResult
     */
    protected function getIdsWithoutFiltering():array {

        $arrResult	= array();
        $sql		= 'SELECT ticket.id FROM ticket WHERE project_id IN('.implode(',', $this->projectIds).')
                       ORDER BY updated_at DESC LIMIT ' . config('app.max_tickets');
        $arrTickets	= \DB::select( $sql );

        foreach( $arrTickets as $t ) {
            $arrResult[]		= $t->id;
        }
        return $arrResult;
    }



    /**
     * If fulltext textinput is set, execute query in fulltext tavble
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrResult
     */
    protected function getIdsFromFulltext():array {
        $arrIds                     = array();
        $arrResult					= array();
        $arrResult['filtered']		= false;

        if( isset($this->params['fulltext'] ) == true && $this->params['fulltext'] != '') {
            $arrResult['filtered']		= true;
            $ids                        = \DB::table('ticket_search_index')->select('ticket_id')
                                        ->where('data', 'LIKE', '%' . $this->params['fulltext'] . '%' )
                                        ->whereIn('project_id', $this->projectIds)
                                        ->join('ticket', 'ticket_id', '=', 'id' )
                                        ->get();
            $arrIds                     = get_ids( $ids, 'ticket_id');
        }


        $arrResult['ids']			= $arrIds;
        return $arrResult;
    }




    /**
     * If attributefilter is active
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrResult
     */
    protected function getIdsWithAttributeFiltering():array {
        $arrIds                     = array();
        $arrResult					= array();
        $arrResult['filtered']		= false;
        $arrResult['ids']			= $arrIds;
        return $arrResult;
    }


    /**
     * If filters  are active
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return array $arrResult
     */
    protected function getIdsWithFiltering():array {
        $tickets			= \App\Models\Ticket::query()->select('id')->whereIn('project_id', $this->projectIds );
        $doFiltering		= false;
        if( isset( $this->params['project_id'] ) && $this->params['project_id'] > 0 ) {
            $doFiltering	= true;
            $tickets->where('project_id', '=' , $this->params['project_id'] );
        }

        if( isset( $this->params['project_id'] ) && $this->params['project_id'] > 0 ) {
            $doFiltering	= true;
            $tickets->where('project_id', '=' , $this->params['project_id'] );
        }


        if( isset( $this->params['created_by'] ) && $this->params['created_by'] > 0 ) {
            $doFiltering	= true;
            $tickets->where('created_by', '=' , $this->params['created_by'] );
        }


        if( isset( $this->params['name'] ) && $this->params['name'] != '' ) {
            $doFiltering	= true;
            $tickets->where('name', 'LIKE' , '%' . $this->params['name'] . '%' );
        }



        if( isset( $this->params['unique_id'] ) && $this->params['unique_id'] != '' ) {
            $doFiltering	= true;
            $tickets->where('unique_id', 'LIKE' , '%' . $this->params['unique_id'] . '%' );
        }



        if( isset( $this->params['assigned'] ) && $this->params['assigned'] > 0 ) {
            $doFiltering	= true;
            $tickets->whereHas( 'assigned', function( $query ){
                $query->where( 'id', '=', $this->params['assigned'] );
            });
        }


        if( isset( $this->params['priority_id'] ) && $this->params['priority_id'] > 0 ) {
            $doFiltering	= true;
            $tickets->where('priority_id', '=' , $this->params['priority_id'] );
        }

        if( isset( $this->params['action_id'] ) && $this->params['action_id'] > 0 ) {
            $doFiltering	= true;
            $tickets->where('action_id', '=' , $this->params['action_id'] );
        }

        if( isset( $this->params['state_id'] ) && $this->params['state_id'] > 0 ) {
            $doFiltering	= true;
            $arrFilterItems	= array();
            $data			= $this->params['state_id'];
            foreach( $data as $item ) {
                if( strstr( $item, '{') !== false ) {
                    $id				= str_replace(array('{', '}'), '', $item );


                    $arrStates			= StateIsInStategroup::where('state_group_id', '=', $id  )->get();
                    foreach( $arrStates as $state ) {
                        $arrFilterItems[]		= $state->state_id;
                    }
                }
                else {
                    $arrFilterItems[]		= $item;
                }
            }
            $arrFilterItems					= array_unique($arrFilterItems);
            $tickets->whereIn('state_id', $arrFilterItems );
        }




        $arrIds						= array();
        if( $doFiltering == true ) {
            $arrIds					= $tickets->pluck('id')->toArray();
        }
        $arrResult					= array();
        $arrResult['filtered']		= $doFiltering;
        $arrResult['ids']			= $arrIds;
        return $arrResult;


    }

}
