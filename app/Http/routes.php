<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', '\App\Http\Controllers\Auth\AuthController@logout');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/add', 'UsersController@add_form');
Route::post('/add', 'UsersController@add');


Route::get('/show/{id}', 'usersController@show');

/*
Route::get('/show/{id}/{role}', function ($id,$role) {


    //search in admin or user table with id parametre
    ///TODO
    $entity=null;
    $permution=null;
    if($role=="admin")
    {
        //searche in admin's table with id
        $entity=DB::table('admins')
            ->where('id','=',$id)
            ->first();
    }

    else
    {
        //searche in admin's table with id
        $entity=DB::table('users')
            ->where('id','=',$id)
            ->first();
        //search in permution the liste of permution correspond to user's id
        $permution=DB::table('permutionOfUser')
            ->where('user_id','=',$id)
            ->get();
        dd($permution);
    }

        return view('show')
            ->with('entity',$entity)
            ->with('role',$role)
            ->with('permutions',$permution);

});


