<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class DefaultController extends BaseController
{
    function home(){
        return view('default.home');
    }

    function welcome(){
        return new Response("Página de welcome");
    }

    function borrarCookie(){
        return redirect()->route('home')->withoutCookie('autor');
    }

    function exemple()
    {
        $ufs = array();

        $uf1 = new \stdClass();
        $uf1->codi = 'UF1';
        $uf1->denominacio = 'Programació web en entorn servidor';
        $uf2 = new \stdClass();
        $uf2->codi = 'UF2';
        $uf2->denominacio = 'Generació dinàmica de pàgines web';
        $uf3 = new \stdClass();
        $uf3->codi = 'UF3';
        $uf3->denominacio = 'Tècniques d’accés a dades';
        $uf4 = new \stdClass();
        $uf4->codi = 'UF4';
        $uf4->denominacio = 'Serveis web. Pàgines dinàmiques interactives. Webs híbrids';

        array_push($ufs, $uf1);
        array_push($ufs, $uf2);
        array_push($ufs, $uf3);
        array_push($ufs, $uf4);

        return view('default.exemple', [
            'ufs' => $ufs
        ]);
    }
}
