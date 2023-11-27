<?php

namespace App\Http\Controllers\Project;
use App\Indexer\UserHasProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends Project
{

    /**
     * Saves a project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('project');
        /** @var \App\Models\Project $entity */
        $entity		    = \App\Models\Project::findOrNew( $data['id'] );

        $arrResult                  = array();
        $arrResult['move_to']       = url('project');

        $blnIsValid     = true;
        if( $entity->id == '' ) {
            $blnIsValid             = true;
            $projectsToLoad         = \App\Models\Project::where('unique_id', '=', $data['unique_id'])->first();
            if( $projectsToLoad ) {
                $blnIsValid         = false;

                $arrResult['message_type']      = 'danger';
                $arrResult['message']           = __('project.unique_id_already_exists');
            }
        }


        if( $blnIsValid == true ) {
            $entity->addData( $data );
            if( $entity->id == '' ) {
                $entity->increment_id       = 1;
            }
            $entity->save();

            $this->saveAttributesInProject( $entity, $request->get('attribute', array() ) );
            $this->saveUserInProject( $entity, $request->get('users', array() ) );

            $indexer                        = new UserHasProject();
            $indexer->calculate();

            $arrResult['message_type']      = 'success';
            $arrResult['message']           = __('global.entity_saved');
            $arrResult['move_to']           = url('project/edit/' . $entity->id );
        }


        $request->session()->flash('message',  $arrResult );


        return redirect( $arrResult['move_to'] );

    }



    /**
     * Save Attributes to the Project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\Project $entity
     * @param array $attributes
     * @return void
     */
    protected function saveAttributesInProject( $entity, $attributes ):void {
        // Clear Attibute project relation and save new attributes
        DB::table('project_has_attribute')->where('project_id', '=', $entity->id)->delete();
        $arrSave            = array();
        foreach( $attributes as $attribute ) {
            if( $attribute['active'] == 1 ) {
                $itemToSave     = array(
                    'project_id'        => $entity->id,
                    'attribute_id'      => $attribute['attribute_id'],
                    'position'          => intval( $attribute['position']) > 0 ? $attribute['position'] : 99
                );
                $arrSave[]      = $itemToSave;
            }
        }

        // multiple insert
        if( empty( $arrSave ) == false ) {
            DB::table('project_has_attribute')->insert( $arrSave );
        }
    }



    /**
     * Save Users to the Project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\Project $entity
     * @param array $users
     * @return void
     */
    protected function saveUserInProject( $entity, $users ):void {
        // Clear User project relation and save new users
        DB::table('user_has_project')->where('project_id', '=', $entity->id)->delete();
        $arrSave            = array();
        foreach( $users as $userId ) {
            $itemToSave     = array(
                'project_id'        => $entity->id,
                'user_id'           => $userId,
            );
            $arrSave[]      = $itemToSave;
        }


        // multiple insert
        if( empty( $arrSave ) == false ) {
            DB::table('user_has_project')->insert( $arrSave );
        }
    }


}
