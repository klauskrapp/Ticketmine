<?php

namespace App\Http\Controllers\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Delete extends Project
{

    /**
     *
     * Deletes a project
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param Request $request
     * @param \App\Models\Project $project
     * @return  array $result
     *
     */
    public function execute(Request $request, \App\Models\Project $project ): array {
        $result         = array(
            'message_type'   => 'success',
            'message'        => __('global.entity_deleted')
        );
        if( $project ) {
            $project->delete();
        }

        return $result;
    }


}
