@extends('layouts.admin')



@section('content')

   {{--  @if(Session::has('deleted_user')) <p class="bg-danger">{{ session('deleted_user') }}</p> @endif
    @if(Session::has('updated_user')) <p class="bg-primary">{{ session('updated_user') }}</p> @endif
    @if(Session::has('created_user')) <p class="bg-primary">{{ session('created_user') }}</p> @endif --}}
	<h1>Users</h1>

  <div id="usersTable">
  	<table class="table table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Active</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @if(count($users) > 0 )


        	@foreach($users as $user)

        	  <tr>
        	  	 <td>{{ $user->id }}</td>
        	  	 <td> @if($user->photo) <img height=50 width=50 src="{{ $user->photo->file }}" /> @else no user photo   @endif</td>
        	  	 <td> {{ $user->name }}</td>
        	  	 <td> {{ $user->email }} </td>
        	  	 <td> @if($user->role) {{ $user->role->name }} @endif </td>
        	  	 <td> {!! $user->is_active == 1 ? '<font color="green">Active</font>' : '<font color="red">No Active</font>' !!} </td>
        	  	 <td> @if($user->created_at)  {{ $user->created_at->diffForHumans()}}    @endif </td>
        	  	 <td> @if($user->updated_at)  {{ $user->updated_at->diffForHumans()}}    @endif</td>
        	  	 <td> <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a> </td>
               <th> 
                  {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy' , $user->id ], 'class'=>'deleteUser' ]) !!}

                    {!! Form::submit('Delete' , ['class'=>'btn btn-danger']) !!}

                  {!! Form::close() !!}
               </th>
        	  </tr>

  	    @endforeach

  	  @else 
  	  	 <p>
  	  	 	0 users found on the database.
  	  	 </p>
  	  @endif
      </tbody>
    </table>
</div>
@endsection