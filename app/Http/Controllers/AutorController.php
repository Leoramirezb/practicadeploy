<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Autor;

class AutorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list()
    {
        $autors = Autor::all();

        return view('autor.list', ['autors' => $autors]);
    }

    function new(Request $request)
    {
        if ($request->isMethod('post')) {
            // recollim els camps del formulari en un objecte autor

            $request->validate([
                'nom' => 'required|max:20',
                'cognoms' => 'required|max:30'
            ]);
            $autor = new Autor;
            $autor->nom= $request->nom;
            $autor->cognoms = $request->cognoms;
            if($request->file('imatge')){
                $imagen=$request->file('imatge');
                $nombrefichero=$autor->nom.'_'.$autor->cognoms.hash('sha256', 'estaeslaimagendelautor'.time()).'.'.$request->file('imatge')->extension();
                $imagen->move(public_path(env('RUTA_IMATGES')), $nombrefichero);
                $autor->imatge=$nombrefichero;
            }
            $autor->save();

            return redirect()->route('autor_list')->with('status', 'Nou autor '.$autor->nom.' creat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $autors = Autor::all();

        return view('autor.new', ['autors' => $autors]);
    }

    function edit(Request $request)
    {
        $autor = Autor::find($request->id);

        if ($request->isMethod('post')) {
            // recollim els camps del formulari en un objecte autor

            $request->validate([
                'nom' => 'required|max:20',
                'cognoms' => 'required|max:30'
            ]);
            $autor->nom= $request->nom;
            $autor->cognoms = $request->cognoms;
            if(isset($request->borrarimg)){
                File::delete(public_path(env('RUTA_IMATGES').'/'.$autor->imatge));
                $autor->imatge=null;
            }
            if($request->file('imatge')){
                File::delete(public_path(env('RUTA_IMATGES').'/'.$autor->imatge));
                $imagen=$request->file('imatge');
                $nombrefichero=$autor->nom.'_'.$autor->cognoms.hash('sha256', 'estaeslaimagendelautor'.time()).'.'.$request->file('imatge')->extension();
                $imagen->move(public_path(env('RUTA_IMATGES')), $nombrefichero);
                $autor->imatge=$nombrefichero;
            }
            $autor->save();

            return redirect()->route('autor_list')->with('status', 'Autor '.$autor->nom.' editat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $autors = Autor::all();

        return view('autor.edit', ['autor' => $autor, 'autors' => $autors]);
    }

    function delete($id)
    {
        $autor = Autor::find($id);
        File::delete(public_path(env('RUTA_IMATGES').'/'.$autor->imatge));
        $autor->delete();

        return redirect()->route('autor_list')->with('status', 'Autor '.$autor->nom.' eliminat!');
    }
}
