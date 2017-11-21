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

        return view('home')
            ->with('users',$users_entities)
            ->with('permution',$tab);
    }
}
