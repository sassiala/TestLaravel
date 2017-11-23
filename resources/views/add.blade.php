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

<!--if the current user has add permution , he access to add page
        else
        redirect to home page
        -->
@if( User::as_Permution('add',Auth::user()->id) )
    @section('content')
    {{"hello "}}
    <div class="container">
        <form method="POST" action="{!! url('add') !!}" id="ajouter" accept-charset="UTF-8">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {!! csrf_field() !!}
            <label for="nom">Entrez votre nom : </label>
            <input name="name" type="text"  id="name">
            <label for="nom">Entrez votre Email : </label>
            <input name="email" type="email" id="email">
            <label for="nom">Entrez votre password : </label>
            <input name="password" type="password" id="password">

            <select name="role" >
                <option value="SUPER-ADMIN">SUPER-ADMIN</option>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
            </select>

            <label for="nom">saisier les parmutions : </label>
            <div class="chips" name="permution"></div>

            <input class="btn-info" type="submit" value="Envoyer !">

            <div id="permution" name="permution">

            </div>

        </form>
    </div>
    <div class="btn-info" id="send">send</div>


@stop
@else
    <?php
            ///TODO : redirect to page with messageb
            redirect()->route('notif',['notif'=>'pisst']);
    ?>
@endif

@section('script_footer')


    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.chips').material_chip();
        $(function () {
            ///TODO : send data to controller
            $('#ajouter').submit(function () {

                //get data from chips form
                var data = $('.chips').material_chip('data');
                //here I have an array fill with data of chips
                //if I will get the first one : data[0].tag
                ///------------------------------

                document.getElementById('permution').innerHTML = data;
                //$.post('add', {permution: "ala"});
            })
        });
    </script>
@stop