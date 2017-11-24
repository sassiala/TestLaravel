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

    public static function get_all()
    {
        $users=DB::table('users')
            ->select('*')
            ->get();
        return($users);
    }

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
}
