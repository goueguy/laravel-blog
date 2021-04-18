@extends("layouts.app")
@section('content')

<h1>POSTS</h1>

	@if(!empty($post))
			<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body p-3">
								<h3><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a>
								</h3>
								<p class="text-justify">{{$post->body}}</p>
								<small>Written on {{$post->created_at}}</small>
							</div>
						</div>
						
					</div>
				
			</div>
	@else

	@endif

@endsection