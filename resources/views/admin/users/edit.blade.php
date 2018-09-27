@extends('layouts.admin')



@section('content')


<h1>Update a new user</h1>

<div class="row">

<div class="col-sm-3">

<p>
	 @if($user->photo) <img class="img-responsive img-rounded"  src="{{ $user->photo->file }}" /> @else no user photo @endif
</p>

</div>


<div class="col-sm-9">

	{!! Form::model($user,['method'=>'PATCH' , 'action' => ['AdminUsersController@update' , $user->id] , 'files'=>true]) !!}


	<div class="form-group">
		{!! Form::label('name' , 'Name:') !!}
		{!! Form::text('name',null,['class'=>'form-control']); !!}
	</div>

	<div class="form-group">
		{!! Form::label('email' , 'Email:') !!}
		{!! Form::email('email',null,['class'=>'form-control']); !!}
	</div>

	<div class="form-group">
		{!! Form::label('password' , 'Password:') !!}
		{!! Form::password('password',['class'=>'form-control']); !!}
	</div>

	<div class="form-group">
		{!! Form::label('role_id' , 'Role:') !!}
		{!! Form::select('role_id',  $roles ,null,['class'=>'form-control']); !!}
	</div>

	<div class="form-group">
		{!! Form::label('is_active' , 'Active:') !!}
		{!! Form::select('is_active',array(1=>'Active',0=>'No Active'),null,['class'=>'form-control']); !!}
	</div>

	<div class="form-group">
		{!! Form::label('photo_id' , 'Photo:') !!}
		{!! Form::file('photo_id' ,null,['class'=>'form-control']); !!}
	</div>



	<div class="form-group">
		{!! Form::submit('Update',['class'=>'btn btn-primary col-sm-6']) !!}
	</div>


	{!! Form::close() !!}


	{!! Form::open(['method'=>'DELETE' , 'action' => ['AdminUsersController@destroy', $user->id] ]) !!}

	{!! Form::submit('Delete User' , ['class'=>'btn btn-danger col-sm-6']) !!}

	{!! Form::close() !!}


</div>


</div>

<div class="row">

@include('includes.form_errors');

</div>

@endsection