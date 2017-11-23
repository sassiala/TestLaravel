<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
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
    public function index()
    {
        $users_entities= DB::select("select * from users");

        //parcour users by users
        foreach ($users_entities as $user)
        {
            $permution_of_user= DB::select("select * from accessof");
            //get all
        }
        return view('home')
            ->with('users',$users_entities);
    }

}
