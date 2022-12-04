<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Llibre;
use App\Models\Autor;

class LlibreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list()
    {
        $llibres = Llibre::all();

        return view('llibre.list', ['llibres' => $llibres]);
    }

    function new(Request $request)
    {
        if ($request->isMethod('post')) {
            // recollim els camps del formulari en un objecte llibre

            $request->validate([
                'titol' => 'required|min:2|max:20',
                'vendes' => 'required',
                'dataP' => 'before_or_equal:today'
            ]);
            $llibre = new Llibre;
            $llibre->titol = $request->titol;
            $llibre->dataP = $request->dataP;
            $llibre->vendes = $request->vendes;
            $llibre->autor_id = $request->autor_id;
            $llibre->save();

            if($request->autor_id)
                return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->cookie('autor', $llibre->autor_id, 360);
            else
                return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->withoutCookie('autor');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $autors = Autor::all();

        $cookieautor=$request->cookie('autor');
        return view('llibre.new', ['autors' => $autors, 'cookie' => $cookieautor]);
    }

    function edit(Request $request)
    {
        $llibre = Llibre::find($request->id);

        if ($request->isMethod('post')) {
            // recollim els camps del formulari en un objecte llibre

            $request->validate([
                'titol' => 'required|min:2|max:20',
                'vendes' => 'required',
                'dataP' => 'before_or_equal:today'
            ]);

            $llibre->titol = $request->titol;
            $llibre->dataP = $request->dataP;
            $llibre->vendes = $request->vendes;
            $llibre->autor_id = $request->autor_id;
            $llibre->save();

            return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' editat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $autors = Autor::all();

        return view('llibre.edit', ['llibre' => $llibre, 'autors' => $autors]);
    }

    function delete($id)
    {
        $llibre = Llibre::find($id);
        $llibre->delete();

        return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' eliminat!');
    }
}
