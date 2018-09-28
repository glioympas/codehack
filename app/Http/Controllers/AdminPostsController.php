<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Category;
use App\Post;
use App\Photo;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('images' , $name);
            $photo = Photo::create(['file' => $name]);
            $data['photo_id'] = $photo->id;
        }   

   
        $user->posts()->create($data);

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.edit' , compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        $data = $request->all();
        // $post = Post::findOrFail($id);

        if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $data['photo_id'] = $photo->id;
        }
        Auth::user()->posts()->whereId($id)->first()->update($data);
        // $post->update($data);
        Session::flash('post_updated', 'Post updated successfully.');
        return redirect('/admin/posts');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->photo)
        {
            if(file_exists(public_path() . $post->photo->file))
                @unlink(public_path() . $post->photo->file );//delete the post's photo
            
            $post->photo()->delete();    //delete the photo from the database
        }
        $post->delete(); // delete the post
        return ['deleted'=>'Post deleted successfully.'];

        // Session::flash('post_deleted' , 'Post deleted successfully.');
        // return redirect('/admin/posts');

    }
}
