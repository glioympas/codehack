@extends('layouts.admin')


@section('content')

<h1>Edit category</h1>


@include('includes.form_errors');


{!! Form::model($category,['method'=>'PATCH' , 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
		
		<div class="form-group">
			{!! Form::label('name', 'Category Name:') !!}
			{!! Form::text('name' , null , ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Update' , ['class'=> 'btn btn-primary']) !!}
		</div>

{!! Form::close() !!}


@endsection