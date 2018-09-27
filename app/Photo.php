<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    private $uploads = '/images/';


    public function getFileAttribute($value)
    {
    	return $this->uploads . $value;
    }


}
