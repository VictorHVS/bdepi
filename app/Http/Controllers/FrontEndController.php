<?php

namespace App\Http\Controllers;

use App\Research;
use App\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    /**
     * @var Research
     */
    private $pesquisa;

    public function __construct(Research $pesquisa)
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

        if(\Auth::attempt(["email" => "vhv.sousa@gmail.com", "senha" => "123456"])){
            dd("Logado");
        }else{
            dd("não logado");
        }

//        $pesquisas = $this->pesquisa->where("is_publico", 1)->get();
//
//        return view('busca')->with("pesquisas", $pesquisas);
    }

    public function createPesquisa(Request $request)
    {
        //dd($request->get('titulo') . $request->get('resumo') . $request->get('palavras_chave'));

        $pesquisa = new Research(
            [
                'usuario_id' => 1,
                'nome' => $request->get('titulo'),
                'resumo' => $request->get('resumo'),
                'is_publico' => true
            ]);

        $user = User::find(1);
        $pesquisa->usuario = $user;
        $pesquisa->save();
    }

}
