@extends('layouts.admin')


@section('content')



<div class="col-sm-5">
	<h2>Create a new category</h2>

	@include('includes.form_errors');

    @if(Session::has('category_created')) <p class=bg-primary style="padding:6px"> {{ session('category_created') }} </p>  @endif 

	{!! Form::open(['method'=>'POST' , 'action'=>'AdminCategoriesController@store']) !!}
		
		<div class="form-group">
			{!! Form::label('name', 'Category Name:') !!}
			{!! Form::text('name' , null , ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Create' , ['class'=> 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

</div>

<div class="col-sm-7">
	<div id="categoriesTable">
		<h1>All Categories</h1>

		<table class="table">
		      <thead>
		        <tr>
		          <th>Id</th>
		          <th>Name</th>
		          <th>Posts</th>
		          <th>Edit</th>
		          <th>Delete</th>
		        </tr>
		      </thead>

		      <tbody>

			      	@if(count($categories) > 0 )


			      		@foreach($categories as $category)

			      		<tr>
			      			<td>{{ $category->id }}</td>
			      			<td>{{ $category->name }} </td>
			      			<td>{{ sizeof($category->posts) }} </td>
			      			<td> <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a> </td>
			      			<td>
			      				{!! Form::open(['method'=>'DELETE' , 'action'=>['AdminCategoriesController@destroy', $category->id] , 'class' => 'deleteCategory' ]) !!}
			      					{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
			      				{!! Form::close() !!}
			      			</td>
			      		</tr>


			      		@endforeach




			      	@endif
		      	
		      </tbody>
	    </table>





	</div>

</div>

@endsection