@extends('layouts.app')

@section('content')
    <div class="row page-header">

        <h1 class="col-lg-1">
            <a class="btn btn-primary btn-lg" href="{{url("add")}}">
                Add new user
            </a>
        </h1>

    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="mydata">
            <thead>
            <tr class="bg-primary text-white">
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permution</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @if($users)
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>

                            @if($user->role=='SUPER-ADMIN')
                                <div class="btn-danger">ALL</div>
                            @elseif($permutions[$user->id])
                                @foreach($permutions[$user->id] as $permution)
                                    <div class="btn-info">{{$permution->name}}</div>
                                @endforeach
                            @else
                                {{'nothing'}}
                            @endif
                        </td>
                        <td>
                            <ul>
                                <li>
                                    <a class="btn btn-xs btn-link" href="{{url("show/".$user->id)}}">
                                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                        show
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-xs btn-link" href="{{url("edit/".$user->id)}}">
                                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                        edit
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>
@endsection

@section('script_footer')
    <script>
        $('#mydata').dataTable();
    </script>
@endsection
