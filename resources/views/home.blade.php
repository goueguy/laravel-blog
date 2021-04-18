@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <a href="{{route('posts.create')}}" class="btn btn-primary">Add Posts</a>
                   <h1 class="pt-4">Your blog posts</h1>
                   @if(count($posts) > 1)
                       <table class="table table-bordered">
                           <thead class="thead-dark">
                               
                               <tr>
                                   <th>ID</th>
                                   <th>TITLE</th>
                                   <th>BODY</th>
                                   <th>DATE</th>
                                   <th>ACTION</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($posts as $key=> $post)
                               <tr>
                                    <td>{{$key+1}}</td>
                                   <td>{{$post->title}}</td>
                                   <td>{{$post->body}}</td>
                                   <td>{{$post->created_at}}</td>
                                   <td>
                                      <a href="{{route('posts.show',$post->id)}}" class="btn btn-info btn-sm float-left">See</a>
                                     
                                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('voulez-vous supprimer ce post');">delete</button>
                                </form>

                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-danger btn-sm">update</a>
                                
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>

                       </table>
                    @else
                        <p>No posts available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
