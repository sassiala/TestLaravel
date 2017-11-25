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


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="mydata">
            <tbody>
            <tr>
                <td>
                    {{ 'name' }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ 'Email' }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ 'Permutions' }}
                </td>
                <td>
                    @if($permutions)
                        @foreach($permutions as $p)
                            {{$p->name.' + '}}
                        @endforeach
                    @else
                        {{'nothings'}}
                    @endif

                </td>
            </tr>
            <tr>
                <td>
                    <div class="chips-initial"></div>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection
@elseif(Route::getCurrentRoute()->getParameter('id')==Auth::user()->id)
    @section('content')


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="mydata">
            <tbody>
            <tr>
                <td>
                    {{ 'name' }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ 'Email' }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ 'Permutions' }}
                </td>
                <td>
                    @if($permutions)
                        @foreach($permutions as $p)
                            {{$p->name.' + '}}
                        @endforeach
                    @else
                        {{'nothings'}}
                    @endif

                </td>
            </tr>
            <tr>
                <td>
                    <div class="chips-initial"></div>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection
@else
        @if( User::as_Permution('display',Auth::user()->id) )

            @section('content')


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="mydata">
            <tbody>
                <tr>
                    <td>
                        {{ 'name' }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ 'Email' }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ 'Permutions' }}
                    </td>
                    <td>
                        @if($permutions)
                            @foreach($permutions as $p)
                                {{$p->name.' + '}}
                            @endforeach
                        @else
                            {{'nothings'}}
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="chips-initial"></div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

@endsection

        @else
            {{Route::getCurrentRoute()->getParameter('id')}}
            <?php
                return redirect()->route('show', ['id' => Auth::user()->id]);
            ?>
        @endif
@endif

@section('script_footer')

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>

    <script>
        $('.chips-initial').material_chip({
            data: [{
                tag: 'Apple',
            }, {
                tag: 'Microsoft',
            }, {
                tag: 'Google',
            }],
        });
    </script>
@stop