<?php

namespace App\Http\Controllers\Quickfind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Ticket extends Quickfind
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Get Users by Name
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return array $data
     *
     */
    public function execute(Request $request ):array {
        $projectIds = \DB::table('users_visible_projects_index')->where('user_id', '=', $request->get('user_id'))->get()->pluck('project_id')->toArray();


        $data       = \DB::table('ticket')
            ->orWhere('name', 'LIKE', '%' . $request->get('name') . '%')
            ->orWhere('unique_id', 'LIKE', '%' . $request->get('name') . '%')
            ->whereIn('project_id', $projectIds )
            ->limit(5)
            ->get()->toArray();


        return $data;
    }


}
