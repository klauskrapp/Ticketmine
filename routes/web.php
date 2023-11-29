<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get( '/', 'App\Http\Controllers\Login\Index@execute' );
Route::post( '/dologin', 'App\Http\Controllers\Login\Dologin@execute' );

Route::middleware(['logged_in'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Dashboard\Index@execute');
    Route::get('/dashboard/activitystream/{dashboardelement}', 'App\Http\Controllers\Dashboard\Activitystream@execute');
    Route::get('/dashboard/fetchfilterlist/{dashboardelement}/{filter}', 'App\Http\Controllers\Dashboard\Fetchfilterlist@execute');

    Route::get( '/ticket/create', 'App\Http\Controllers\Ticket\Create\Index@execute' );

    Route::get( '/ticket/form/{project}', 'App\Http\Controllers\Ticket\Create\Form@execute' );
    Route::post( '/ticket/save', 'App\Http\Controllers\Ticket\Create\Save@execute' );


    Route::get('/browse/{unique_id}', 'App\Http\Controllers\Ticket\View\Index@execute');
    Route::get( '/ticket/actionorpriority', 'App\Http\Controllers\Ticket\View\ActionOrPriority@execute' );
    Route::get( '/ticket/groupstate', 'App\Http\Controllers\Ticket\View\Groupstate@execute' );
    Route::post( '/ticket/saveupperentity', 'App\Http\Controllers\Ticket\View\SaveUpperEntity@execute' );
    Route::post( '/ticket/saveperson', 'App\Http\Controllers\Ticket\View\SavePerson@execute' );
    Route::post( '/ticket/uploadattachment', 'App\Http\Controllers\Ticket\View\Uploadattachment@execute' );
    Route::post( '/ticket/savecomment', 'App\Http\Controllers\Ticket\View\Savecomment@execute' );
    Route::get( '/ticket/getcomment', 'App\Http\Controllers\Ticket\View\Getcomment@execute' );
    Route::get( '/ticket/getpersons', 'App\Http\Controllers\Ticket\View\Getpersons@execute' );
    Route::get( '/ticket/fetchall', 'App\Http\Controllers\Ticket\Search\Fetchall@execute' );
    Route::get( '/ticket/downloadattachment/{ticketattachment}', 'App\Http\Controllers\Ticket\View\Downloadattachment@execute' );
    Route::get( '/ticket/removeattachment/{ticketattachment}', 'App\Http\Controllers\Ticket\View\Removeattachment@execute' );
    Route::get( '/ticket/removecomment/{ticketcomment}', 'App\Http\Controllers\Ticket\View\Removecomment@execute' );
    Route::get( '/ticket/delete/{ticket}', 'App\Http\Controllers\Ticket\View\Delete@execute' );
    Route::get( '/ticket/getattribute/{ticket}/attribute/{attribute}', 'App\Http\Controllers\Ticket\View\Getattribute@execute' );
    Route::post( '/ticket/saveattribute/{ticket}/attribute/{attribute}', 'App\Http\Controllers\Ticket\View\Saveattribute@execute' );



    Route::get( '/search', 'App\Http\Controllers\Ticket\Search\Index@execute' );


    Route::get( '/manage', 'App\Http\Controllers\Manage\Index@execute' );
    Route::get( '/manage/fetchall', 'App\Http\Controllers\Manage\Fetchall@execute' );
    Route::get( '/manage/edit/{dashboard?}', 'App\Http\Controllers\Manage\Edit@execute' );
    Route::post( '/manage/save', 'App\Http\Controllers\Manage\Save@execute' );
    Route::get( '/manage/delete/{dashboard}', 'App\Http\Controllers\Manage\Delete@execute' );

    Route::get( '/manage/configure/{dashboard}', 'App\Http\Controllers\Manage\Configure\Index@execute' );
    Route::get( '/manage/configure/{dashboard}/fetchall', 'App\Http\Controllers\Manage\Configure\Fetchall@execute' );

    Route::get( '/manage/configure/{dashboard}/edit/{dashboardelement?}', 'App\Http\Controllers\Manage\Configure\Edit@execute' );
    Route::get( '/manage/configure/{dashboard}/delete/{dashboardelement}', 'App\Http\Controllers\Manage\Configure\Delete@execute' );


    Route::post( '/manage/configure/{dashboard}/save', 'App\Http\Controllers\Manage\Configure\Save@execute' );

    Route::post( '/filter/save', 'App\Http\Controllers\Filter\Save@execute' );
    Route::get( '/filter/moveto/{filter}', 'App\Http\Controllers\Filter\Moveto@execute' );
    Route::get( '/filter/delete/{filter}', 'App\Http\Controllers\Filter\Delete@execute' );



    Route::get( '/quickfind/user', 'App\Http\Controllers\Quickfind\User@execute' );
    Route::get( '/quickfind/ticket', 'App\Http\Controllers\Quickfind\Ticket@execute' );

    Route::get( '/profile', 'App\Http\Controllers\User\Profile@execute' );

});


Route::middleware(['is_admin'])->group(function () {
    Route::get( '/project', 'App\Http\Controllers\Project\Index@execute' );
    Route::get( '/project/fetchall', 'App\Http\Controllers\Project\Fetchall@execute' );
    Route::get( '/project/delete/{project}', 'App\Http\Controllers\Project\Delete@execute' );
    Route::get( '/project/edit/{project?}', 'App\Http\Controllers\Project\Edit@execute' );
    Route::post( '/project/save', 'App\Http\Controllers\Project\Save@execute' );


    Route::get( '/user', 'App\Http\Controllers\User\Index@execute' );
    Route::get( '/user/fetchall', 'App\Http\Controllers\User\Fetchall@execute' );
    Route::get( '/user/delete/{user}', 'App\Http\Controllers\User\Delete@execute' );
    Route::get( '/user/edit/{user?}', 'App\Http\Controllers\User\Edit@execute' );
    Route::post( '/user/save', 'App\Http\Controllers\User\Save@execute' );




    Route::get( '/attribute', 'App\Http\Controllers\Attribute\Index@execute' );
    Route::get( '/attribute/fetchall', 'App\Http\Controllers\Attribute\Fetchall@execute' );
    Route::get( '/attribute/delete/{attribute}', 'App\Http\Controllers\Attribute\Delete@execute' );
    Route::get( '/attribute/edit/{attribute?}', 'App\Http\Controllers\Attribute\Edit@execute' );
    Route::post( '/attribute/save', 'App\Http\Controllers\Attribute\Save@execute' );


    Route::get( '/priority', 'App\Http\Controllers\Priority\Index@execute' );
    Route::get( '/priority/fetchall', 'App\Http\Controllers\Priority\Fetchall@execute' );
    Route::get( '/priority/delete/{priority}', 'App\Http\Controllers\Priority\Delete@execute' );
    Route::get( '/priority/edit/{priority?}', 'App\Http\Controllers\Priority\Edit@execute' );
    Route::post( '/priority/save', 'App\Http\Controllers\Priority\Save@execute' );


    Route::get( '/action', 'App\Http\Controllers\Action\Index@execute' );
    Route::get( '/action/fetchall', 'App\Http\Controllers\Action\Fetchall@execute' );
    Route::get( '/action/delete/{action}', 'App\Http\Controllers\Action\Delete@execute' );
    Route::get( '/action/edit/{action?}', 'App\Http\Controllers\Action\Edit@execute' );
    Route::post( '/action/save', 'App\Http\Controllers\Action\Save@execute' );





    Route::get( '/state', 'App\Http\Controllers\State\Index@execute' );
    Route::get( '/state/fetchall', 'App\Http\Controllers\State\Fetchall@execute' );
    Route::get( '/state/delete/{state}', 'App\Http\Controllers\State\Delete@execute' );
    Route::get( '/state/chain/{state}', 'App\Http\Controllers\State\Chain@execute' );
    Route::get( '/state/edit/{state?}', 'App\Http\Controllers\State\Edit@execute' );
    Route::post( '/state/save', 'App\Http\Controllers\State\Save@execute' );
    Route::post( '/state/savechain', 'App\Http\Controllers\State\Savechain@execute' );


    Route::get( '/groupstate', 'App\Http\Controllers\Groupstate\Index@execute' );
    Route::get( '/groupstate/fetchall', 'App\Http\Controllers\Groupstate\Fetchall@execute' );
    Route::get( '/groupstate/delete/{groupstate}', 'App\Http\Controllers\Groupstate\Delete@execute' );
    Route::get( '/groupstate/edit/{groupstate?}', 'App\Http\Controllers\Groupstate\Edit@execute' );
    Route::post( '/groupstate/save', 'App\Http\Controllers\Groupstate\Save@execute' );
});
