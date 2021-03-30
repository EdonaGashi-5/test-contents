<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Article\Create as CreateRequest;
use App\Http\Requests\Article\Update as UpdateRequest;

use Illuminate\Support\Facades\Config;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleListResource;

class ArticleController extends Controller
{
    public function indexGuest(Request $request)
    {


        $articles = Article::where('status', Config::get('constants.ARTICLE_STATUS_PUBLISHED'))->get();
        return ArticleListResource::collection($articles);
    }


    public function showGuest($id)
    {


        $article = Article::findOrFail($id);
        return ($article->status == Config::get('constants.ARTICLE_STATUS_PUBLISHED')) ? new ArticleResource($article) : response()->json(['message' => 'Unauthenticade.'], 401);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {

        //dd($request->user()->id);

        $articles = Article::orderBy('created_at','desc')->get();
        return ArticleListResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $request->validated();

        $article = new Article();
        $article->title = $request->input('title');
        $article->contents = $request->input('contents');
        $article->abstract = $request->input('abstract');
        //id utente loggato
        $article->author_id =  $request->user()->id;
        $article->category_id = $request->input('category_id');
        $article->status = Config::get('constants.ARTICLE_STATUS_DRAFTED');

        if($article->save())
        {
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Article\Update  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {   //validazione request, salva tutti i dati all'interno della variabile $data

        $data = $request->validated();
        $isPublishRequest = isset($data['status']);
        $article = Article::findOrFail($id);
        $this->authorize('update', [$article, $isPublishRequest]);
        $article->title = $data['title'];
        $article->contents = $data['contents'];
        $article->abstract = $data['abstract'];
        $article->category_id = $data['category_id'];
        if($article->save())
        {
            return new ArticleResource($article);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if($article->delete())
        {
            return new ArticleResource($article);
        }
    }
}
