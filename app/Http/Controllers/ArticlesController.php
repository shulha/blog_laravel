<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;
use App\Tag;
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
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
//        dd('index');

        $articles = Article::latest('published_at')->published()->get();
//        $articles = Article::latest('created_at')->get();

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
        $tags = Tag::pluck('name', 'id');

        return view('articles.create', compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
//        dd($request->input('tags'));

        $this->createArticle($request);

//        session()->flash('flash_message', 'Your article has been created!');
//        session()->flash('flash_message_important', true);

//        return redirect('articles')->with([
//            'flash_message' => 'Your article has been created!',
//            'flash_message_important' => true
//        ]);

        flash()->success('Your article has been created!');

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

        $tags = Tag::pluck('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
    }

    public function update(Article $article, ArticleRequest $request)
    {
//        $article = Article::findOrFail($id);

        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');

    }

    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }
}
