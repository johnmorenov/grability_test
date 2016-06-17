<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Classes\QueryProcessingClass;

use App\Http\Requests;
use App\Http\Controllers\CubeCalculationsController;
use App\Http\Controllers\StoreDataController;

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
            
            if ($aParts['tipo'] === 'UPDATE') {
                // CACHE de datos
                // Las queries de tipo UPDATE se almacenaran en BD para consultarla luego con las QUERY
                $aResult['result'] = StoreDataController::storeData($aParts);
            }
            else if ($aParts['tipo'] === 'QUERY') {
                $aResult['result'] = 'Sum = '.CubeCalculationsController::cubeSummation($this->N, $aParts);
            }
        }
        
    	return Response::json( $aResult );
    }
}
