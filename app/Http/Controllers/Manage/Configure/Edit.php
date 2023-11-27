<?php

namespace App\Http\Controllers\Manage\Configure;
use App\Http\Controllers\Manage\Manage;
use App\Models\Dashboard;
use App\Models\DashboardElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Configure
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param  $dashboardelement

     *
     */
    public function execute(Request $request, Dashboard $dashboard, DashboardElement $dashboardelement ) {



        $arrResult      = array(
            'entity'        => $dashboardelement
        );

        return $arrResult;
    }


}
