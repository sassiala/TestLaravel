@extends('layouts.app')

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
                        @foreach($permutions as $p)
                            {{$p->name.' + '}}
                        @endforeach
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

@endsection