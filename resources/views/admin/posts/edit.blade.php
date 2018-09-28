@extends('layouts.admin')



@section('content')

<h1>Edit post</h1>

<div class="row">
	<div class="col-sm-3">
		@if($post->photo) <img class="img-responsive" src="{{ $post->photo->file }}"> @else 'no photo' @endif
	</div>
	<div class="col-sm-9">
		{!! Form::model($post, ['method'=>'PATCH' , 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

			<div class="form-group">
				{!! Form::label('title' , 'Title:') !!}
				{!! Form::text('title', null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('category_id' , 'Category:') !!}
				{!! Form::select('category_id', [''=>'select category'] + $categories , null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('photo_id', 'Photo:') !!}
				{!! Form::file('photo_id' , null , ['class'=>'form-control']) !!}

			</div>

			<div class="form-group">
				{!! Form::label('body' , 'Body:') !!}
				{!! Form::textarea('body' , null, ['class'=>'form-control', ]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Save Post', ['class'=>'btn btn-primary col-sm-6']) !!}
			</div>

		{!! Form::close() !!}


		{!! Form::open(['method'=>'DELETE' , 'action' => ['AdminPostsController@destroy' , $post->id] ]) !!}

		{!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}

		{!! Form::close() !!}
	</div>

</div>

<div class="row">
	@include('includes.form_errors')
</div>

@endsection