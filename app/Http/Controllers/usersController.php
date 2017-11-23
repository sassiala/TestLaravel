<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

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
        dump(User::get_permution(1));
        dump(User::as_Permution('add',1));
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
        $role = $request->input('role');
        $permution = $request->input('permution');
        dd($name,$email,$password,$role,$permution);
        return view('show');
    }
}
