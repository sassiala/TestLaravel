@extends('layouts.app')

@section('content')
    <div class="row page-header">

        <h1 class="col-lg-1">
            <a class="btn btn-primary btn-lg" href="#">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
                    </span>
            </a>
            <h1>{{$entity->name}}</h1>
        </h1>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="mydata">

            <tbody>
            <tr>
                <td>Name</td>
                <td>{{$entity->name}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$entity->email}}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td>{{$role}}</td>
            </tr>
            <tr>
                <td>Permution</td>
                @if($role == "admin")
                    <td>{{"ALL"}}</td>
                @else
                    <td>{{"NUll"}}</td>
                @endif
            </tr>
            </tbody>
        </table>
    </div>
@endsection