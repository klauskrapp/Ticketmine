<?php

namespace App\Http\Controllers\Project;
use App\Indexer\UserHasProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Index extends Project
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
     *
     */
    public function execute(Request $request):\Illuminate\View\View
    {
        $indexer        = new UserHasProject();
        $indexer->calculate();
        $mView	= View::make( 'project.index' );
        return $mView;
    }


}
