<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|min:5|max:250',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image'
        ], [
            'title.required' => 'Il titolo deve essere valorizzato',
            'content.required' => 'Il contenuto deve essere valorizzato',
            'title.max' => 'Hai superato i :attribute caratteri',
            'content.min' => 'Minimo 5 caratteri',
            'content.max' => 'Hai superato i :attribute caratteri',
            'category_id.required' => 'La categoria deve essere selezionata',
            'category_id.exists' => 'La categoria selezionata non esiste',
            'image' => 'il file deve essere un\'immagine'
        ]);

        $postData = $request->all();
        $newPost = new Post();
        $newPost -> fill($postData);

        $newPost->slug = Post::convertToSlug($newPost->title);

        if(array_key_exists('image',$postData)){
            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        $newPost -> save();
        return redirect()-> Route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        $tags = Tag::all();

        if (!$id) {
        abort(404);
        }

        $category = Category::find($post->category_id);

        return view('admin.posts.show', compact('post'), ['category'=> $category] ); //
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
        $categories = Category::all();
        $tags= Tag::all();

        $post= Post::find($id);
        if (!$id) {
        abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
       $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|min:5|max:250',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image'
        ], [
            'title.required' => 'Il titolo deve essere valorizzato',
            'content.required' => 'Il contenuto deve essere valorizzato',
            'title.max' => 'Hai superato i :attribute caratteri',
            'content.min' => 'Minimo 5 caratteri',
            'content.max' => 'Hai superato i :attribute caratteri',
            'category_id.required' => 'La categoria deve essere selezionata',
            'category_id.exists' => 'La categoria selezionata non esiste',
            'image' => 'il file deve essere un\'immagine'
        ]);

        $post = Post::find($id);
        $postData = $request->all();

        $post->fill($postData);
        $post->slug = Post::convertToSlug($post->title);

        if(array_key_exists('image',$postData)){
            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        if($post->cover){
            Storage::delate('$post->cover');
        }

        $post->update();
        return redirect()->route('admin.posts.index',);
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
        $post=Post::find($id);
        $post->tag()->sync([]);
        Storage::delete($post->cover);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
