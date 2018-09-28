<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

class AdminMediasController extends Controller
{
    public function index()
    {
    	$photos = Photo::all();
    	return view('admin.media.index' , compact('photos'));
    }

    public function create()
    {
    	return view('admin.media.create');
    }

    public function store(Request $request)
    {
    	$file = $request->file('file');
		$name = time() . $file->getClientOriginalName();

		$file->move('images', $name);
		Photo::create(['file'=> $name]);
    }

    public function destroy($id)
    {

    	$photo = Photo::findOrFail($id);
    	if($photo->user || $photo->post)
    		return ['notdeleted'=>"Photo can't be deleted because it belongs in a post or in a user."];
    	else
    	{
    		if(file_exists(public_path() . $photo->file))
    			@unlink(public_path() . $photo->file);
    		$photo->delete();
    		return ['deleted'=>'Photo deleted.'];
    	}

    }
}
