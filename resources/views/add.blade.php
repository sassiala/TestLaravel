<?php

use App\User;
use App\Http\Controllers\HomeController;
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
@if(Auth::user()->role=='SUPER-ADMIN')
    @section('content')
    {{"hello "}}
    <div class="container">
        <form onsubmit="myFunction()" method="POST" action="{!! url('add') !!}" id="ajouter" accept-charset="UTF-8">

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

            <input id="ichips" type="hidden" name="chips">

            <input class="btn-info" type="submit" value="Envoyer !">

            <div id="permution" name="permution">

            </div>

        </form>
    </div>
    <div class="btn-info" id="send">send</div>


@stop
@elseif( User::as_Permution('add',Auth::user()->id) )
    @section('content')
    {{"hello "}}
    <div class="container">
        <form onsubmit="myFunction()" method="POST" action="{!! url('add') !!}" id="ajouter" accept-charset="UTF-8">

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

            <input id="ichips" type="hidden" name="chips">

            <input class="btn-info" type="submit" value="Envoyer !" id="envoyer">

            <div id="permution" name="permution">

            </div>

        </form>
    </div>
    <div class="btn-info" id="send">send</div>


@stop
@else
    <?php

            $home=new HomeController();
            $home->index();
    ?>
@endif

@section('script_footer')
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>

    <script>
        function myFunction() {
            var data = $('.chips').material_chip('data');
            var dataString = JSON.stringify(data);

            $("#ichips").val("ala");
        }
        /*
        $(function() {

            var data = $('.chips').material_chip();
            var dataString = JSON.stringify(data);

            $("#ichips").val('test');
        });

/*

        $(function() {

            var data = $('.chips').material_chip();
            var dataString = JSON.stringify(data);
            $(document).on('submit', '#ajouter', function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
            });
        });
            /*
            $(document).on('submit', '#ajouter', function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
                    .done(function (data) {
                        console.log('done');
                    })
                    .fail(function (data) {
                        console.log('fail')
                    });
            });
        });


        /*
        $(document).ready(function () {
        //    var data=$('.chips').material_chip();
          //  var dataString = JSON.stringify(data);
            $('ajouter').submit(function (e) {
                e.preventDefault();
                $.post('add',{data:"ala"},function (data) {
                    console.log(data);
                })
            })
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        /*
        var data=$('.chips').material_chip();
        var dataString = JSON.stringify(data);
        $('#envoyer').submit(function () {
            $.ajax(
                {
                    type: "POST",
                    url: "/add",
                    data: {'data':dataString,_token: token},
                    success: function () {
                        console.log(data);
                    }
                }
            )
        });
       /* $(function () {
            ///TODO : send data to controller
            $('#ajouter').submit(function () {

                //get data from chips form
                var data = $('.chips').material_chip('data');
                var dataString = JSON.stringify(data);
                document.getElementById("permution").value=dataString;

                $.post('add',{data:dataString});
                $.ajax(
                    {
                        type: "POST",
                        url: "add",
                        data: {'data':dataString,_token: token},
                        success: function () {
                            console.log(data);
                        }
                    }
                )
            })
        });*/
    </script>
@stop