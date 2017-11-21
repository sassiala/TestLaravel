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

    $users_entities= DB::select("select * from users");
    $tab=null;
    if($users_entities)
    {
        $tab=array();
        //parcours the user's liste
        $i=0;
        foreach ($users_entities as $user)
        {
            //select * form permutionOf where permutionOf->id =$user->id
            $entities=DB::table('permutionOfUser')
                ->where('user_id','=',$user->id)
                ->get();
            //==>we have liste of user's permution_id
            //select name of permution and set in new tab
            foreach ($entities as $entity)
            {
                $permution=DB::table('permution')
                    ->where('id','=',$entity->permution_id)
                    ->first();
                $tab[$user->id][$i]=$permution->name;
                $i++;
            }
        }
    }

    return view('welcome')
        ->with('users',$users_entities)
        ->with('permution',$tab);
});

Route::get('logout', '\App\Http\Controllers\Auth\AuthController@logout');

Route::auth();

Route::get('/home', 'HomeController@index');

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


