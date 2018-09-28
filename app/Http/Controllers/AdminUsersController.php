<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

       if(trim($request->password) == '')
       {
            $data = $request->except('password');
       }
       else{
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
        }

       if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images' , $name);
            $photo = Photo::create(['file' => $name]);
            $data['photo_id'] = $photo->id;
       }
      
       User::create($data);

       Session::flash('created_user' , 'User has been created');

       return redirect('/admin/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**g the specified resource.
     *
     * @param  int  $id
     * Show the form for editin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.users.edit' , compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
           if(trim($request->password) == '')
           {
                $data = $request->except('password');
           }
           else{
                $data = $request->all();
                $data['password'] = bcrypt($request->password);
            }


           if($file = $request->file('photo_id')){
                $name = time() . $file->getClientOriginalName();
                $file->move('images' , $name);
                $photo = Photo::create(['file' => $name]);
                $data['photo_id'] = $photo->id;
           }

           $data['password'] = bcrypt($request->password);
           User::findOrFail($id)->update($data);

           Session::flash('updated_user' , 'User has been updated');

           return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if($user->photo)
        {
             unlink(public_path() . $user->photo->file); //delete the user's photo
        }
        $user->delete();
        return ["deleted"=>'User deleted successfully.'];
        
        // Session::flash('deleted_user' , 'The user has been deleted');
        // return redirect('/admin/users');
    }
}
