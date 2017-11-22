<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        $permution = $request->input('data');
        dd($name,$email,$password,$role,$permution[0].tag);
        return view('show');
    }
}
