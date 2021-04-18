@extends("layouts.app")
@section('content')

<h1>POSTS</h1>

	@if(count($posts)>1)
		
			<div class="row">
				@foreach($posts as $post)
					<div class="col-md-4">
						<div class="card">
							<div class="card-body p-3">
								<h3><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a>
								</h3>
								<p class="text-justify">{{Str::limit($post->body,100)}}</p>
								<small>Written on {{$post->created_at}}</small>
							</div>
							<div class="card-footer text-center">
								<a href="#">See More</a>
							</div>
						</div>
						
					</div>
				@endforeach
			</div>
	@else

	@endif

@endsection