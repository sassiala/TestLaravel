@extends('layouts.app')

@section('content')
    @if($notif)
        <h1>{{$notif}}</h1>
    @else
        <h1>{{'Welcome'}}</h1>
    @endif

@stop