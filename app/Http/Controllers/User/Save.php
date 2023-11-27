<?php

namespace App\Http\Controllers\User;
use App\Helpers\Crypt;
use App\Indexer\UserHasProject;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class Save extends User
{

    /**
     * Saves a User
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse
     *
     */
    public function execute(Request $request ):\Illuminate\Http\RedirectResponse {

        $data           = $request->get('user');
        $arrSettings    = $request->get('usersettings', array());
        /** @var \App\Models\User $entity */
        $entity		    = \App\Models\User::findOrNew( $data['id'] );
        $entity->email  = $data['email'];
        $entity->name   = $data['name'];
        if( auth()->user()->is_admin == 1 ) {
            $entity->is_admin                           = $data['is_admin'];
            $entity->is_active                          = $data['is_active'];
            $entity->is_free_for_all_projects           = $data['is_free_for_all_projects'];
            $this->saveProjectsInUser( $entity, $request->get('projects', array() ) );
        }

        if( isset( $data['password']) == true && $data['password'] != '' ) {
            $entity->password               = Crypt::generateUserPassword( $data['password'], 'user' );
        }


        $this->uploadAvatar( $entity );

        if( $entity->id == '' ) {
            $entity->unique_id      = md5( time() . '_' . uuid_create() );
        }
        $entity->save();

        $indexer                        = new UserHasProject();
        $indexer->calculate();
        $this->saveUserSettings( $entity, $arrSettings );





        $arrResult                      = array();
        $arrResult['message_type']      = 'success';
        $arrResult['message']           = __('global.entity_saved');
        $arrResult['move_to']           = $request->get('save_back_url') == '' ? url('user/edit/' . $entity->id ) : url( $request->get('save_back_url') );


        $request->session()->flash('message',  $arrResult );
        return redirect( $arrResult['move_to'] );

    }


    /**
     * Save Users to the Project
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     * @param \App\Models\User $entity
     * @param array $projects
     * @return void
     */
    protected function saveProjectsInUser( \App\Models\User $entity, $projects ):void {
        // Clear User project relation and save new users
        DB::table('user_has_project')->where('user_id', '=', $entity->id)->delete();
        $arrSave            = array();
        foreach( $projects as $projectId ) {
            $itemToSave     = array(
                'user_id'        => $entity->id,
                'project_id'           => $projectId,
            );
            $arrSave[]      = $itemToSave;
        }


        // multiple insert
        if( empty( $arrSave ) == false ) {
            DB::table('user_has_project')->insert( $arrSave );
        }
    }

    /**
     * Upload an avatar
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param \App\Models\User $user
     * @return void
     *
     */
    protected function uploadAvatar( \App\Models\User $user ):\App\Models\User {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = request()->file('avatar');
        if( is_object( $file ) == true && $file->getError() == 0 && $file->getClientOriginalName() != ''
            && strstr( $file->getMimeType(), 'image') !== false ) {

            if( is_dir( public_path('avatar') ) == false ) {
                mkdir( public_path('avatar'), 0777 );
            }
            $arrEnding      = explode('.', $file->getClientOriginalName() );
            $ending         = 'png';
            if( count( $arrEnding ) > 1  ) {
                $ending     = end( $arrEnding );
            }
            $newPath        = public_path('avatar' ) . DIRECTORY_SEPARATOR . $user->unique_id . '.' . $ending;
            move_uploaded_file( $file->getPathname(), $newPath  );
            $user->avatar   = $user->unique_id . '.' . $ending;
        }
        return $user;
    }


    /**
     * Saves users settings
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param \App\Models\User $user
     * @param array $arrSettings
     * @return void
     *
     */
    protected function saveUserSettings( \App\Models\User $user, array $arrSettings ):void {

        // load the settings for users notifications
        $usersSettings              = \App\Helpers\User::getSettings();
        $arrSettingsByCode          = array_merge( $usersSettings['dropdown'], $usersSettings['multiselect'], $usersSettings['gridcolumns']);
        $cSettings                  = Settings::whereIn('unique_id', $arrSettingsByCode )->get();
        $cByCode                    = index_by( $cSettings, 'unique_id');



        $settingIds                 = $cSettings->pluck('id')->toArray();
        // remove the existing settings for the user
        DB::table('user_has_settings')->where('user_id', $user->id)->whereIn('settings_id', $settingIds)->delete();
        $arrSave                    = array();
        foreach( $arrSettings as $unique_id => $value ) {
            /** @var Settings $mSetting */
            $mSetting               = $cByCode[ $unique_id ];
            $valToSave              = $value;
            // setting is multiselect
            if( is_array( $value ) == true ) {
                $tmpVal             = 0;
                foreach( $value as $val ) {
                    $tmpVal         += $val;
                }

                $valToSave          = $tmpVal;
            }


            // add to save array
            $arrSave[]              = array(
                'user_id'           => $user->id,
                'settings_id'       => $mSetting->id,
                'value'             => $valToSave
            );
        }
        // finally save
        if( empty( $arrSave ) == false ) {
            DB::table('user_has_settings')->insert( $arrSave );
        }
    }
}
