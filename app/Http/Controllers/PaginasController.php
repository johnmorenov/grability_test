<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;

class PaginasController extends Controller
{
    public function operations() {
    	$aPost = Request::all();
    	
    	$aParams = [
			'cubeDimensions' => $aPost['cubeDimensions']
		];

    	return view('operations', $aParams)->with($aParams);
    }
}
