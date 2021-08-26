<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(2);

        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required|max:1800',
            'image' => 'nullable|image|max:1999',
        ],[
            'title.required' => 'Enter a descriptive heading',
            'body.required' => 'The content field is required',
        ]);
        $article = new Article();
        $article->title = Str::of($request->input('title'))->trim()->ucfirst();
        $article->body = Str::of($request->input('body'))->trim()->ucfirst();
        $article->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
          $file = $request->file('image')->getClientOriginalName();
          $sent = $file.'.'.time();
          $path = $request->file('image')->storeAs('articles',$sent, 'public');
        }
        else{
            $sent = 'noimage.jpg';
        }
        $article->image = $sent;
        $article->save();
       return redirect('/articles')->with('success','You successfully created an Article, Thank You!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        //check if article exit
        if (!isset($article)) {
            return redirect('/articles')->with('error','no article found');
        }
        //checking if article id == article user
        if (Auth::user()->id != $article->user->id) {

            return redirect('/articles')->with('error','You did not create this article');
        }

        return view('articles.edit',compact('article'));
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required|max:1800',
            'image' => 'nullable|image|max:1999',
        ],[
            'title.required' => 'Enter a descriptive heading',
            'body.required' => 'The content field is required',
        ]);
        $article =  Article::find($id);
        $article->title = Str::of($request->input('title'))->trim()->ucfirst();
        $article->body = Str::of($request->input('body'))->trim()->ucfirst();
        $article->user_id = Auth::user()->id;
        if ($request->hasFile('image') != '') {
          $file = $request->file('image')->getClientOriginalName();
          $sent = $file.'.'.time();
          $path = $request->file('image')->storeAs('articles',$sent, 'public');
        }
        else{
            $sent = $article->image;
        }
        $article->image = $sent;
        $article->save();
       return redirect('/articles')->with('success','You successfully updated your Article, Thank You!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        //check if article exit
        if (!isset($article)) {
            return redirect('/articles')->with('error','no article found');
        }
        //check if article belongs to actual user
        if (Auth::user()->id != $article->user->id) {

            return redirect('/articles')->with('error','You did not create this article');
        }
        //delete image from storage.
        if ($article->image != 'noimage.jpg') {
            Storage::delete('/storage/articles/'.$article->image);
        }

        $article->delete();

        return redirect('/articles')->with('success','Article deleted successfully,');
    }
}
