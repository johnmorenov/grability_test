<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
	protected $table = "cube";

    protected $fillable = [
    	'x1',
    	'y1',
    	'z1',
    	'W'
    ];
}
