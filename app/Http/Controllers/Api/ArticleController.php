<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $name = $request->input('name');
        $section = $request->input('section');

        if (Article::where('name', $name) && Article::where('section', $section)){
            return response()->json(['error' => 'Article already exists'], 400);
        }

        $article = Article::create([
            'name' => $request->name,
            'section' => $request->section
        ]);
        $article->save();
        return response()->json($article, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);

        $article -> update([
            'entry' => $request->entry,
            'emotion' => $request->emotion
        ]);
        $article->save();
        return response()->json($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();
    }

    public function truncate(){
        DB::table('articles')->truncate();
        return response()->json(["All articles deleted successfully"], 200);
    }
}
