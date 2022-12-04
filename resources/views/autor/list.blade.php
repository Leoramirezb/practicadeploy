@extends('layout')

@section('title', 'Llistat de llibres')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat d'autors</h1>
    <a href="{{ route('autor_new') }}">+ Nou autor</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
        <tr>
            <th>Nom</th><th>Cognoms</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($autors as $autor)
            <tr>
                <td>{{ $autor->nom }}</td><td>{{ $autor->cognoms }}</td><td><img src="{{ asset(env('RUTA_IMATGES').'/'.$autor->imatge) }}" alt="" style="max-width:200px"></td>
                <td>
                    <a href="{{ route('autor_delete', ['id' => $autor->id]) }}" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    <a href="{{ route('autor_edit', ['id' => $autor->id]) }}">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>
@endsection
