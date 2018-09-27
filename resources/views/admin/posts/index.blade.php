@extends('layouts.admin')



@section('content')

<h1>All Posts</h1>




	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>User</th>
				<th>Category</th>
				<th>Photo</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>
		<tbody>
			@if($posts)

				@foreach($posts as $post)

					<tr>

						<td>{{ $post->id }}</td>
						<td>{{ $post->user ? $post->user->name : 'no user' }} </td>
						<td>{{ $post->category ? $post->category->name : 'no category' }}</td>
						<td>@if($post->photo) <img height=50 width=50 src="{{ $post->photo->file }}" >  @else no post photo @endif</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->body }}</td>
						<td>{{ $post->created_at->diffForHumans() }}</td>
						<td>{{ $post->updated_at->diffForHumans() }}</td>
					</tr>


				@endforeach



			@endif
		</tbody>
	</table>




@endsection