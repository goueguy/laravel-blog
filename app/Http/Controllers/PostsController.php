<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('id','desc')->get();
        return view("posts.index")->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
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

            "title"=>'required|min:3',
            "body"=>'required|min:3',
            "cover_image"=>"image|required|max:1024|mimes:jpeg,jpg,bmp,png"
        ]);

        if($request->hasFile("cover_image")){
            //get file with extension
            $fileNameWithExtension = $request->file("cover_image")->getClientOriginalName();
            //get filename
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file("cover_image")->getClientOriginalExtension();
            //file to store in database
            $fileNameStore = $fileName."_".time()."_".$extension;
            //$path = $request->file("cover_image")->store("public/cover_images",$fileNameStore);
             $request->file("cover_image")->move("cover_images", $fileNameStore);
        }else{
            $fileNameStore = "default.png";
        }
        $data = [

            "body"=>$request->input("body"),
            "title"=>$request->input('title'),
            "user_id"=>Auth::id(),
            "cover_image"=>$fileNameStore
        ];
        Post::create($data);

        return redirect('posts')->with("status","Post inserted ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view("posts.show")->with("post",$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view("posts.edit")->with("post",$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $this->validate($request,[

            "title"=>'required|min:3',
            "body"=>'required|min:3'
        ]);

        $data = [

            "body"=>$request->input("body"),
            "title"=>$request->input('title')
        ];
        Post::where('id', $request->input('id_post'))->update($data);
        return redirect('posts')->with("status","Post updated ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('posts')->with("status","Post deleted");
    }
}
