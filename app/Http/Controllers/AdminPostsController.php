<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\PostCreatRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
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

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreatRequest $request)
    {
        //
        $input = $request->all();

            $user = Auth::user();

            if($file = $request->file('photo_id'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images',$name);
                $photo = Photo::create(['path'=>$name]);

                $input['photo_id']=$photo->id;
            }

            $user->posts()->create($input);
        Session::flash('created_user','The post has been created');

     //   return $input;
            return redirect('admin/posts');

        //return $request->all();
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
        //
        $categories = Category::lists('name','id')->all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit',compact('post','categories'));
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
        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id'))
        {



            $name= time().$file->getClientOriginalName();
            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
            if($post->photo_id =="" || $post->photo_id ==null )
            {
                $photo = Photo::create(['path'=>$name]);

                $input['photo_id'] = $photo->id;
            }
            else{

                $photo = Photo::find($post->photo_id);
                $photo->path= $name;
                $photo->save();

                $input['photo_id'] = $photo->id;
            }

        }
            Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash('updated_user','The user has been updated');
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
        //
        $post = Post::findOrFail($id);

        unlink(public_path(). $post->photo->path);

        $post->delete();
        Session::flash('deleted_user','The user has been deleted');


        return  redirect('admin/posts');
    }


}
