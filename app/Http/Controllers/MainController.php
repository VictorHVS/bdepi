<?php

namespace App\Http\Controllers;

use App\Dados;
use App\Http\Requests;

class MainController extends Controller
{

    public function index()
    {
//        $dados = file_get_contents(__DIR__ . '/../assets/dado.json');

        $dados = Dados::all();

        return view('index')->with("dados", $this->geoJson($dados));
    }

    function geoJson($dados)
    {
        $features = array();

        foreach ($dados as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => $value->geom,
                'properties' => array(
                    'title' => $value->nome,
                    'description' => $value->info,
                    'marker-color' => "#fc" . rand(1, 9999),
                    'marker-size' => "large"
                )
            );
        };

        return json_encode($features, JSON_PRETTY_PRINT);
    }
}
