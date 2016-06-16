<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;
use App\Cube;

class PaginasController extends Controller
{
    public function operations() {
    	$aPost = Request::all();
    	
    	$aParams = [
			'cubeDimensions' => $aPost['cubeDimensions']
		];

		//Limpiamos el cache de valores de bloques (cubo)
		Cube::truncate();

    	return view('operations', $aParams)->with($aParams);
    }
}
