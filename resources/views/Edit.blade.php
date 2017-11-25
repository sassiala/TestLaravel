<?php
use App\User;
?>

@extends('layouts.app')
@section('meta')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('style_head')

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize/css/materialize.min.css"  media="screen,projection"/>


@stop





    @if(Auth::user()->role=='SUPER-ADMIN')
        @section('content')

            <div class="container">
                <form method="POST" action="{!! url('edit') !!}" id="edit" accept-charset="UTF-8">

                    <label for="nom">Entrez votre nom : </label>
                    <input name="name" type="text"  id="name" value="{{$user->name}}">
                    <br>
                    <label for="nom">Entrez votre Email : </label>
                    <input name="email" type="email" id="email" value="{{$user->email}}">
                    <br>
                    <label for="nom">Entrez votre password : </label>
                    <input name="password" type="password" id="password" value="{{($user->password)}}">
                    <br>
                    <select name="role" >
                        <option value="SUPER-ADMIN">SUPER-ADMIN</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="USER">USER</option>
                    </select>

                    <div class="chips chips-initial"></div>
                </form>
            </div>
        @stop
    @elseif(User::as_Permution('edit',Auth::user()->id) )
        @section('content')

            <div class="container">
                <form method="POST" action="{!! url('edit') !!}" id="edit" accept-charset="UTF-8">

                    <label for="nom">Entrez votre nom : </label>
                    <input name="name" type="text"  id="name" value="{{$user->name}}">
                    <label for="nom">Entrez votre Email : </label>
                    <input name="email" type="email" id="email" value="{{$user->email}}">
                    <label for="nom">Entrez votre password : </label>
                    <input name="password" type="password" id="password" value="{{($user->password)}}">

                    <select name="role" >
                        <option value="SUPER-ADMIN">SUPER-ADMIN</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="USER">USER</option>
                    </select>
                </form>
            </div>
        @stop
    @endif

@section('script_footer')
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>


@stop