<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Research;
use App\Services\KeywordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    /**
     * @var Research
     */
    private $pesquisa;
    /**
     * @var KeywordService
     */
    private $keywordService;

    public function __construct(Research $pesquisa, KeywordService $keywordService)
    {
        $this->pesquisa = $pesquisa;
        $this->keywordService = $keywordService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->get("k");

        if(isset($title)){
            $title = $request->get("k");
            $cond = ['title', 'ilike', "%" . $title . "%"];
            $researches = $this->pesquisa->where(["is_public" => 1, $cond])->orderBy('created_at', 'desc')->get();
        }else{
            $researches = $this->pesquisa->where("is_public", 1)->orderBy('created_at', 'desc')->get();
        }

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

        $keys = explode(";", $request->get('key_words'));
        $keys = $this->keywordService->save($keys);

        $research->save();
        $research->keyWords()->sync($keys);

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
