<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * get all permutions of user_id
     */
    public static function get_permution($user_id)
    {
        //$user = DB::table('users')->where('name', 'John')->first();
        $listPermutions=
            DB::table('accessof')
                ->select('id')
                ->where('user_id','=',$user_id)
                ->get();
        $permutions=null;
        if($listPermutions)
        {
            $array=array();
            foreach ($listPermutions as $l)
            {
                array_push($array,$l->id);
            }
            $permutions=
                DB::table('permution')
                    ->select('*')
                    ->whereIn('id',$array)
                    ->get();
        }
        return ($permutions);
    }

    /*
     * return true if user_id has permution_name
     */
    public static function as_Permution($permution_name,$user_id)
    {
        $permutions=self::get_permution($user_id);
        $bool=false;
        if($permutions)
        {
            foreach ($permutions as $p)
            {
                if($p->name==$permution_name)
                    $bool=true;
            }
        }
        return $bool;
    }

    /*
     * get all fields of user_id
     */
    public static function get($user_id)
    {
        $user=
            DB::table('users')
                ->select('*')
                ->where('id','=',$user_id)
                ->first();
        $permution=self::get_permution($user_id);

        return array('user'=>$user,'permution'=>$permution);
    }

    /*
     * return all users
     */
    public static function get_all()
    {
        $users=DB::table('users')
            ->select('*')
            ->get();
        return($users);
    }

    /*
     * return array contains all permutions of all user
     * array[id_user] contains permutions of id_user
     */
    public static function get_all_permutions()
    {
        $users=self::get_all();
        //i have listes of users

        $array=array();
        foreach ($users as $u)
        {
            $permution=User::get_permution($u->id);
            if($permution)
            {
                $array[$u->id]=$permution;
            }
            else
                $array[$u->id]=null;
            //dump($permution);
            //dump($array);
            //array_push($array[$u->id],$permution);
        }
        //dd($array[0][0]);

        return($array);
    }

    /*
     * return id of permution got in arguments
     */
    public static function get_permution_id($permution_name)
    {
        $permution_id=DB::table('permution')
            ->select('id')
            ->where('name','=',$permution_name)
            ->first();
        return($permution_id);
    }

    /*
     * return bool true if permutions is not null
     * process to affect the permutions got in parametre to user_id
     */
    public static function add_permution_to($user_id,$permutions)
    {
        //$permutions is an array
        if($permutions)
        {
            foreach ($permutions as $p)
            {
                //$p has name of permution we need her id
                $access_id=self::get_permution_id($p);
                DB::table('accessof')->
                insert
                ([
                    ['user_id' => $user_id,
                        'access_id'=>$access_id
                    ]
                ]);
            }
            return(true);
        }
        else
        {
            return(false);
        }


    }
}
