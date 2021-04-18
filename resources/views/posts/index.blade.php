@extends("layouts.app")
@section('content')

<h1>POSTS</h1>
	@if(session('status'))
			<div class="alert alert-success">{{session('status')}}
			</div>
	@endif
	@if(count($posts)>1)
		
			<div class="row">
				@foreach($posts as $post)
				@canany(["update","delete"],$post)
					<div class="col-md-4">
						<img src="cover_images/{{$post->cover_image}}" style="width: 100%;height:200px" alt="">
					</div>
					<div class="col-md-8 mb-4">

						<div class="card">
							<div class="card-body p-3">
								<h3><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a>
								</h3>
								<p class="text-justify">{{Str::limit($post->body,100)}}</p>
								<small>Written on {{$post->created_at}}</small>
							</div>
							<div class="card-footer d-flex @auth justify-content-between @endauth ">

								<a href="{{route('posts.show',$post->id)}}" class="btn btn-info float-left">See More</a>
								<form action="{{route('posts.destroy',$post->id)}}" method="POST">
									@csrf
									@method("DELETE")
									<button type="submit" class="btn btn-warning" onclick="return confirm('voulez-vous supprimer ce post');">delete</button>
								</form>

								
								<a href="{{route('posts.edit',$post->id)}}" class="btn btn-danger">update</a>
								
							</div>
						</div>
						
					</div>
					@endcanany
				@endforeach
			</div>
	@else

	@endif

@endsection