<?php

namespace App\Http\Controllers\Quickfind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class User extends Quickfind
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
        $data       = \DB::table('user')
            ->rightJoin('users_visible_projects_index', 'user.id', '=', 'users_visible_projects_index.user_id')
            ->where('name', 'LIKE', '%' . $request->get('name') . '%')->limit(5)->get()->toArray();


        return $data;
    }


}
