<?php

namespace App\Indexer;

use App\Models\User;
use App\Models\Project;

class UserHasProject {


    /**
     *
     * Calculate visible projects for all users.
     * Index is triggert after projects or user save
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @return void
     */
    public function calculate():void {
        $projects           = Project::with(array('users'))->get();
        $users              = User::all();

        $arrResult          = array();

        /** @var Project $p */
        foreach( $projects as $p ) {
            // If project is free for all users, use them
            if( $p->is_free_for_all_user == 1 ) {
                $arrResult[ $p->id ]        = $users->pluck('id')->toArray();
            }
            // project is not free for all
            else {
                $usersInProject = $p->users->pluck('id')->toArray();
                $arrResult[ $p->id ]    = $usersInProject;
            }
        }



        // Add users to the projects
        /** @var User $user */
        foreach( $users as $user ) {
            if( $user->is_free_for_all_projects == 1 ) {
                foreach( $projects as $p ) {
                    $arrResult[ $p->id ][]      = $user->id;
                }
            }
        }


        $arrWrite           = array();
        foreach( $arrResult as $projectId => $users ) {
            $users      = array_unique( $users );

            foreach( $users as $user ) {
                $arrWrite[]     = array(
                    'project_id'    => $projectId,
                    'user_id'       => $user
                );
            }
        }

        // write to index table
        \DB::table('users_visible_projects_index')->truncate();
        if( empty( $arrWrite ) == false ) {
            \DB::table('users_visible_projects_index')->insert( $arrWrite );
        }

    }


}
