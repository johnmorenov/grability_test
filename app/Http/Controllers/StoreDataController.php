<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;

use App\Cube;

class StoreDataController extends Controller
{
    public static function storeData($aParts) {
        $sResponse = "";
        
        if($aParts['tipo'] === 'UPDATE') {
            $sResultLabel = 'Cube('.$aParts['x1'].', '.$aParts['y1'].', '.$aParts['z1'].') = '.$aParts['W'].'';

            $oSearch = Cube::where('x1', $aParts['x1'])->where('y1', $aParts['y1'])->where('z1', $aParts['z1'])->first();

            if($oSearch) {
                if($oSearch->update($aParts)) {
                    $sResponse = $sResultLabel.', updated!';
                } else {
                    $sResponse = 'Error al actualizar valor';
                }
            } else {
                if(Cube::create($aParts)) {
                    $sResponse = $sResultLabel.', ok!';
                } else {
                    $sResponse = 'Error al guardar valor';
                }
            }
        }
        
    	return $sResponse;
    }
}
