<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Pesquisa;
use DB;

class FrontEndController extends Controller
{

    /**
     * @var Pesquisa
     */
    private $pesquisa;

    public function  __construct(Pesquisa $pesquisa)
    {
        $this->pesquisa = $pesquisa;
    }

    public function busca($key)
    {
        $cond = ['nome', 'like', "%" . $key ."%"];
        $pesquisas = $this->pesquisa->where(["is_publico" => 1,  $cond] )->get();

        //dd(json_encode($pesquisas));

        return view('busca')->with("pesquisas", $pesquisas);
    }

    public function pesquisas()
    {
        $pesquisas = $this->pesquisa->where("is_publico", 1)->get();

        //dd(json_encode($pesquisas));

        return view('busca')->with("pesquisas", $pesquisas);
    }

}
