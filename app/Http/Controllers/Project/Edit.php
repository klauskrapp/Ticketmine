<?php

namespace App\Http\Controllers\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends Project
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Edits a project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\View\View $mView
     *
     */
    public function execute(Request $request, \App\Models\Project $project ):\Illuminate\View\View {
        $mView	= View::make( 'project.edit', array('entity' => $project) );
        return $mView;
    }


}
