<?php

namespace App\Http\Controllers;

use App\Dado;
use App\Http\Requests;
use GeoJson\GeoJson;
use GeoJson\Tests\Geometry\GeometryCollectionTest;
use Illuminate\Http\Request;
use Phaza\LaravelPostgis\Geometries\GeometryCollection;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;

class MainController extends Controller
{

    public function index()
    {
//        $dados = file_get_contents(__DIR__ . '/../assets/dado.json');

        $dados = Dado::all();

        return view('index')->with("dados", $this->toGeoJSON($dados));
    }

    public function save(Request $request){

        $featuresCollection = json_decode($request->getContent());
        $features = $featuresCollection->features;

        foreach ($features as $key => $value) {
            $collection = new Point(1 , 2);
            $ae = new GeometryCollection([$collection]);
            //dd($ae->jsonSerialize());

            if(!isset($value->properties->id)){
                $dado = new Dado();
                //$dado->geomCollection = new GeometryCollection([$value->geometry]);
                $dado->geom = new Point($value->geometry->coordinates[1], $value->geometry->coordinates[0]);
                $dado->save();
            }
            else if(Dado::all()->where("id", $value->properties->id)){
                $dado = Dado::all()->where("id", $value->properties->id)->first();
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

                $dado = Dado::find($value->properties->id);
                if(!empty($dado))
                    $dado->delete();
            }
        };

        return response()->json($dado);
    }

    public function create(){
        $dados = Dado::all();

        return view('create')->with("dados", $this->toGeoJSON($dados));
    }

    function toGeoJSON($dados)
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

    function toFeatureGroup($dados)
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
