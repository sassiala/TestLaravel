<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class notifController extends Controller
{
    //


    public function notif($notif)
    {
        return view('welcome')
            ->withNotif($notif);
    }
}
