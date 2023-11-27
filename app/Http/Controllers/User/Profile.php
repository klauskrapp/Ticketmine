<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Profile extends User
{


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * edits a user
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     *
     */
    public function execute(Request $request ):\Illuminate\View\View {
        $arrSettings    = \App\Helpers\User::getSettings();
        $user           = \App\Models\User::find( auth()->id() );
        $mView	= View::make( 'user.edit',
            array('entity' => $user,
                'settings_dropdown' => $arrSettings['dropdown'],
                'settings_multiselect' => $arrSettings['multiselect'],
                'settings_column'       => $arrSettings['gridcolumns'],
                'back_url'              => '',
                'save_back_url'         => 'profile'
            ) );
        return $mView;
    }


}
