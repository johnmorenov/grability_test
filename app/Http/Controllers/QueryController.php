<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;
use App\Classes\QueryProcessingClass;
use App\Cube;

use App\Http\Controllers\CubeCalculationsController;

class QueryController extends queryValidationController
{
	var $cubeDimensions, $N;
	var $query;

    public function queryResult() {
    	$aPost = Request::all();
    	
    	// Datos POST
    	$this->cubeDimensions = $this->N = (int) $aPost['cubeDimensions'];
    	$this->query = $aPost['query'];

        $aResult = $this->initValidation();

        if($aResult['result'] === 'ok') {
            $oQuery = new QueryProcessingClass();
            $aParts = $oQuery->queryToArray($this->query);

            // CACHE de datos
            // Las queries de tipo UPDATE se almacenaran en BD para consultarla luego con las QUERY
            if ($aParts['tipo'] === 'UPDATE') {
                $oSearch = Cube::where('x1', $aParts['x1'])->where('y1', $aParts['y1'])->where('z1', $aParts['z1'])->first();
                if($oSearch) {
                    $status = $oSearch->update($aParts);
                } else {
                    $status = Cube::create($aParts);
                }

                if($status) {
                    $aResult['result'] = 'Cube('.$aParts['x1'].', '.$aParts['y1'].', '.$aParts['z1'].') = '.$aParts['W'].', ok!';
                } else {
                    $aResult['result'] = 'Error al almecenar valor';
                }
            }
            else if ($aParts['tipo'] === 'QUERY') {
                $aResult['result'] = 'Sum = '.CubeCalculationsController::cubeSummation($this->N, $aParts);
            }
        }

    	return Response::json( $aResult );
    }
}
