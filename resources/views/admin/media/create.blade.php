@extends('layouts.admin')


@section('styles')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
	
@endsection

@section('content')


<h1>Upload new media</h1>

{!! Form::open(['method'=>'POST' , 'action'=>['AdminMediasController@store' , 'files' =>true] , 'class'=>'dropzone' ]) !!}

{!! Form::close() !!}
@endsection

@section('footer')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

@endsection