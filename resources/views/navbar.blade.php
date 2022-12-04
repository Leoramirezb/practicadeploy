<!-- Navigation -->
<nav>
    <a href="{{ route('home') }}">Inici</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('llibre_list') }}">Llibres</a>

    <a href="{{route('autor_list')}}">Autors</a>

    @if(\Illuminate\Support\Facades\Cookie::has('autor'))
        <a href="{{route('borrarCookie')}}">Borrar cookie</a>
    @endif
</nav>
