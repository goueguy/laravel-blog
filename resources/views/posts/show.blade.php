@extends("layouts.app")
@section('content')

<h1><a href="{{route('posts.index')}}" class="btn btn-success">Go back</a></h1>

	@if(!empty($post))
			<div class="row">
					<div class="col-md-4">
						<img src="/cover_images/{{$post->cover_image}}" style="width: 100%;height:200px" alt="">
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-body p-3">
								<h3><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a>
								</h3>
								<hr>
								<p class="text-justify">{{$post->body}}</p>
								<small>Written on {{$post->created_at}}</small>
							</div>
						</div>
						
					</div>
				
			</div>
	@else

	@endif

@endsection

<!--1 H 47Min 10s-->