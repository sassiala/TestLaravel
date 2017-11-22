@extends('layouts.app')

@section('content')
    {{"hello "}}
    <div class="container">
        <form method="POST" action="{!! url('add') !!}" accept-charset="UTF-8">
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

        </form>
    </div>


@stop

@section('script_footer')
    <script>
        $(function () {
            $('.chips').material_chip();

            var data= $('.chips').material_chip('data');
        });
    </script>
@stop