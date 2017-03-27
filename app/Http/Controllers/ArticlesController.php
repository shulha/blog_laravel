<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{


    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
    }

    public function index()
    {
//        dd('index');

//        $articles = Article::latest('published_at')->published()->get();
        $articles = Article::latest('created_at')->get();

        return view('articles.index', compact('articles'));

    }

    public function show(Article $article)
    {
//        dd('showing');
//        $article = Article::findOrFail($id);

//        "<pre>" . print_r($article) . "</pre>";

//        dd($article->published_at);
/*
        if(is_null($article)){
            abort(404);
        }
*/
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {

        $article = new Article($request->all());
        Auth::user()->articles()->save($article);

//        session()->flash('flash_message', 'Your article has been created!');
//        session()->flash('flash_message_important', true);

//        return redirect('articles')->with([
//            'flash_message' => 'Your article has been created!',
//            'flash_message_important' => true
//        ]);

        flash()->success('Your article has been created!')->important();

        return redirect('articles');
    }

/*
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'body' => 'required']);

        Article::create($request->all());

        return redirect('articles');
    }
*/

    public function edit(Article $article)
    {
//        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, ArticleRequest $request)
    {
//        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');


    }
}
