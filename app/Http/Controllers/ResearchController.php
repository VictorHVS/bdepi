<?php

namespace App\Http\Controllers;

use App\Research;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    /**
     * @var Research
     */
    private $pesquisa;

    public function __construct(Research $pesquisa)
    {
        $this->pesquisa = $pesquisa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researches = $this->pesquisa->where("is_public", 1)->get();
        return view('researches.result')->with("researches", $researches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('researches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //todo validar dados do form e retornar erros
    public function store(Request $request)
    {
        $research = new Research();
        $research->title = $request->get('title');
        $research->abstract = $request->get('abstract');
        $research->is_public = 1;
        $research->user_id = Auth::user()->id;
        $research->save();

        //todo chamar tela de detalhes desta pesquisa
        return redirect()->action('ResearchController@show', ['id' => $research->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $research = $this->pesquisa->find($id);

        return view('researches.detail')->with(["research" => $research, 'data' => $this->toGeoJSON($research->data)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function toGeoJSON($dados)
    {
        $features = array();

        foreach ($dados as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => $value->geom,
                'properties' => array(
                    'title' => $value->title,
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
