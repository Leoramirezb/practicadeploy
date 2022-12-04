@extends('layout')

@section('title', 'Nou Llibre')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nou Llibre</h1>
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
        <form method="POST" action="{{ route('autor_new') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" />
            </div>
            <div>
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms"/>
            </div>
            <div>
                <label for="imatge">Imatge</label>
                <input type="file" name="imatge" accept=".jpg, .jpeg, .png, .gif"/>
            </div>
            <button type="submit">Crear autor</button>
        </form>
    </div>
@endsection
