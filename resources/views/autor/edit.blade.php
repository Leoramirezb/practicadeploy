@extends('layout')

@section('title', 'Editar Autor')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Edit Llibre</h1>
    <a href="{{ route('autor_list') }}">&laquo; Torna</a>
    <div style="margin-top: 20px">
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div style="margin-top: 20px">
        <form method="POST" action="{{ route('autor_edit', ['id' => $autor->id]) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="{{ $autor->nom }}" />
            </div>
            <div>
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms" value="{{ $autor->cognoms }}"/>
            </div>
            <div>
                <p>Imagen actual: {{ $autor->imatge }}</p>
            </div>
            <div>
                <label for="borrarimg">Borrar imagen</label>
                <input type="checkbox" name="borrarimg"/>
            </div>
            <div>
                <label for="imatge">Imatge</label>
                <input type="file" name="imatge" accept=".jpg, .jpeg, .png, .gif"/>
            </div>
            <button type="submit">Editar autor</button>
        </form>
    </div>
@endsection
