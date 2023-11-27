<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class Edit extends User
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
    public function execute(Request $request, \App\Models\User $user ):\Illuminate\View\View {



        $arrSettings    = \App\Helpers\User::getSettings();
        $mView	= View::make( 'user.edit', array('entity' => $user,
            'settings_dropdown' => $arrSettings['dropdown'],
            'settings_multiselect' => $arrSettings['multiselect'] ,
            'settings_column'       => $arrSettings['gridcolumns'],
            'back_url'              => url('user'),
            'save_back_url'         => ''
            ) );
        return $mView;
    }


}
