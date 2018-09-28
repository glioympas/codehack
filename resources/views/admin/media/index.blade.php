@extends('layouts.admin')



@section('content')


	<h1>Media</h1>

<div id="mediaTable">
		<table class="table">
			<thead>
				<th>Id</th>
				<th>Name</th>
				<th>Created</th>
				<th>Belongs</th>
				<th>Delete</th>
			</thead>

			@if(count($photos)>0)

				<tbody>
					@foreach($photos as $photo)

					<tr>
						<td>{{ $photo->id }} </td>
						<td> <img height=50 src="{{ $photo->file }}"></td>
						<td>{{ $photo->created_at ?  $photo->created_at->diffForHumans() : 'no create' }}</td>
						<td>
							@if($photo->post)

								<a class="btn btn-warning" href="{{ route('admin.posts.edit' , $photo->post->id) }}">POST</a>

							@elseif($photo->user)

								<a class="btn btn-primary" href="{{ route('admin.users.edit' , $photo->user->id) }}">USER</a>

							@else

								<a class="btn btn-danger" href="#">NULL</a>

							@endif
						</td>
						<td>
							{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id] , 'class'=>'deleteMedia' ]) !!}
								{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>

					@endforeach	
				</tbody>
			@endif

		</table>
</div>


@endsection