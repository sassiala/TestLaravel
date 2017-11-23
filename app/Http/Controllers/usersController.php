<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $name = $request->input('name');
        $email=$request->input('email');
        $password = $request->input('password');
        $cryptPassword= Crypt::encrypt($password);
        $role = $request->input('role');
       /*
         if($request->ajax())
        {
            dd(Response::json($request->all()));
        }
dd("sorry not ajax");*/

        ///TODO : get Permution liste and set it in table accessof
        ///
        DB::table('users')->
            insert
        ([
            ['name' => $name,
                'email' => $email,
                'password' => $cryptPassword,
                'role' => $role
            ]
        ]);
        return view('show');
    }


    public function show($id)
    {
        $array=User::get($id);
        return view('show')
            ->with('user',$array['user'])
            ->with('permutions',$array['permution']);
    }
}
