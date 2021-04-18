@extends("layouts.app")
@section('content')

<h1 class="text-center">Create Post</h1>
<div class="container">
	<div class="row">
		<div class="col-lg-8 offset-lg-2">
			
			<form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{old('title')}}">
					
				</div>
				@error('title')
						<div class="alert alert-danger">{{$message}}</div>
				@enderror
				<div class="form-group">
					<textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10">{{old('body')}}</textarea>
				</div>
				@error('body')
						<div class="alert alert-danger">{{$message}}</div>
				@enderror
				<div class="form-group">
					<input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" placeholder="Picture">
				</div>
				@error('cover_image')
						<div class="alert alert-danger">{{$message}}</div>
				@enderror
				<button class="btn btn-primary btn-block">SAVE</button>
			</form>
		</div>
	</div>
</div>

@endsection