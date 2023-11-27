<?php

namespace App\Http\Controllers\Login;
use App\Helpers\Crypt;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;


/**
 * Try user's login
 */
class Dologin extends Controller
{

    /**
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     *
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     *
     */
    public function execute(Request $request)
    {
        $moveTo     = '';
        if( $request->request->get('email') != '' && $request->request->get('password') != '' ) {
            $user   = User::where('email', $request->request->get('email'))->where('is_active', '=', 1)->get()->first();
            // register user, if found and password is correct
            if( $user /*&& $user->password == Crypt::generateUserPassword($request->request->get('password'), 'user' ) */) {
                Auth::login($user);
                $moveTo     = 'dashboard';
            }
        }
        return redirect($moveTo );
    }


}
