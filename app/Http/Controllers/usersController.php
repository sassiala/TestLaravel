<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;


class usersController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_form()
    {
        //dump(User::get_permution(1));
        //dump(User::as_Permution('add',1));
        return view('add');
    }


    public function add(Request $request)
    {
        $name = $request->input('name');
        $email=$request->input('email');
        $password = $request->input('password');
        $cryptPassword= bcrypt($password);
        $role = $request->input('role');

        dd($request->all());
       /*
         if($request->ajax())
        {
            dd(Response::json($request->all()));
        }
dd("sorry not ajax");*/

        DB::table('users')->
            insert
        ([
            ['name' => $name,
                'email' => $email,
                'password' => $cryptPassword,
                'role' => $role
            ]
        ]);


///TODO : get permutions from CHIPS_form
        /// push it in array
        /// and use it in functions add_permutions_to($latest_id)
        $permutions=null;
        $new_user_id=DB::table('users')
            ->select('id')
            ->orderBy('id','desc')
            ->first();

        User::add_permution_to($new_user_id,$permutions);

        return view('home')
            ->with('users',User::get_all())
            ->with('permutions',User::get_all_permutions());
    }


    public function show($id)
    {
        $array=User::get($id);
        return view('show')
            ->with('user',$array['user'])
            ->with('permutions',$array['permution']);
    }

    public function edit_form($id)
    {
        $user=User::get($id);

        //array: $user[user]and $user[permution]
        return view('Edit')
            ->with('user',$user['user'])
            ->with('permutions',$user['permution']);
    }
}
