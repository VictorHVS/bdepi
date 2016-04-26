<?php

namespace App\Http\Controllers;

use App\Pesquisa;
use App\Usuario;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    /**
     * @var Pesquisa
     */
    private $pesquisa;

    public function __construct(Pesquisa $pesquisa)
    {
        $this->pesquisa = $pesquisa;
    }

    public function busca($key)
    {
        $cond = ['nome', 'like', "%" . $key . "%"];
        $pesquisas = $this->pesquisa->where(["is_publico" => 1, $cond])->get();

        return view('busca')->with("pesquisas", $pesquisas);
    }

    public function pesquisas()
    {
        $pesquisas = $this->pesquisa->where("is_publico", 1)->get();

        return view('busca')->with("pesquisas", $pesquisas);
    }

    public function createPesquisa(Request $request)
    {
        //dd($request->get('titulo') . $request->get('resumo') . $request->get('palavras_chave'));

        $pesquisa = new Pesquisa(
            [
                'nome' => $request->get('titulo'),
                'resumo' => $request->get('resumo'),
                'is_publico' => true
            ]);

        $user = Usuario::find(1);
        $pesquisa->usuario = $user;
        $pesquisa->save();
    }

}
