<?php

namespace App\Http\Controllers;

use App\Dados;
use App\Http\Requests;
use Illuminate\Http\Request;
use Phaza\LaravelPostgis\Geometries\Point;

class MainController extends Controller
{

    public function index()
    {
//        $dados = file_get_contents(__DIR__ . '/../assets/dado.json');

        $dados = Dados::all();

        return view('index')->with("dados", $this->geoJson($dados));
    }

    public function save(Request $request){

        $featuresCollection = json_decode($request->getContent());
        $features = $featuresCollection->features;
//        $faker = \Faker\Factory::create();

        foreach ($features as $key => $value) {

            if(!isset($value->properties->id)){
                $dado = new Dados();
                $dado->geom = new Point($value->geometry->coordinates[1], $value->geometry->coordinates[0]);
                $dado->save();
            }
            else if(Dados::all()->where("id", $value->properties->id)){
                $dado = Dados::all()->where("id", $value->properties->id)->first();
                $dado->id = $value->properties->id;
                $dado->nome = "temp";
                $dado->geom = new Point($value->geometry->coordinates[1], $value->geometry->coordinates[0]);
                $dado->info = "nada";
                $dado->save();
            }
        };

        return response()->json($request->getContent());
    }

    public function delete(Request $request){

        $features = json_decode($request->getContent());
        $dado = null;
        foreach ($features as $key => $value) {
            if( isset($value->properties->id) ){

                $dado = Dados::find($value->properties->id);
                if(!empty($dado))
                    $dado->delete();
            }
        };

        return response()->json($dado);
    }

    public function create(){
        $dados = Dados::all();

        return view('create')->with("dados", $this->geoJson($dados));
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
                    'id' => $value->id,
                    'marker-color' => "#fc" . rand(1, 9999),
                    'marker-size' => "large"
                )
            );
        };

        return json_encode($features, JSON_PRETTY_PRINT);
    }
}
