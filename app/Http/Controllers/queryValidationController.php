<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;
use App\Classes\QueryProcessingClass;

class queryValidationController extends Controller
{
	var $cubeDimensions, $N;
	var $query;

    public function queryValidation() {
    	$aPost = Request::all();
    	
    	// Datos POST
    	$this->cubeDimensions = $this->N = (int) $aPost['cubeDimensions'];
    	$this->query = $aPost['query'];

    	return Response::json( $this->initValidation() );
    }

    private function initValidation() {
    	$errCod = 0;
    	$errMsg = $result = '';

    	if (!$this->syntaxValidation()) {
    		$errCod = 1;
    		$errMsg = 'Sintaxis incorrecta';
    	}
    	else if (!$this->parametersValidation()) {
    		$errCod = 2;
    		$errMsg = 'La consulta no tiene la cantidad de valores requeridos';
    	}
    	else if (!$this->coordinateValidation()) {
    		$errCod = 3;
    		$errMsg = 'Coordenadas incorrectas';
    	}
        else if (!$this->blockValueValidation()) {
            $errCod = 4;
            $errMsg = 'El valor de un bloque debe estar entre -10^9 y 10^9';
        }

    	if (!$errCod) {
            //EN CONSTRUCCION!!!
    		$result = "resultado de query";
    	}

		return array(
			'errCod' => $errCod,
			'errMsg' => $errMsg,
			'result' => $result
		);
    }

    //Validacion #1 - Sintaxis
    private function syntaxValidation() {
    	if (!preg_match('/^(QUERY|UPDATE)(\s+\-?\d+)+$/i', $this->query)) {
    		return false;
    	}
    	return true;
    }

    //Validacion #2 - Cantidad de parametros permitida
    private function parametersValidation() {
    	$updateVals = $this->N + 1; //valores que vienen al lado de UPDATE
    	$queryVals = $this->N * 2; //valores que vienen al lado de QUERY

    	if (!preg_match('/^QUERY(\s+\-?\d+){'.$queryVals.'}$/i', $this->query) AND !preg_match('/^UPDATE(\s+\-?\d+){'.$updateVals.'}$/i', $this->query)) {
    		return false;
    	}
    	return true;
    }

    //Validacion #3 - Coordenada
    private function coordinateValidation() {
    	$oQuery = new QueryProcessingClass();
    	$aParts = $oQuery->queryToArray($this->query);

    	switch ($aParts['tipo']) {
    		case 'QUERY':
    			if ($aParts['x1'] < 1 OR $aParts['y1'] < 1 OR $aParts['z1'] < 1 OR
    				$aParts['x2'] < $aParts['x1'] OR $aParts['y2'] < $aParts['y1'] OR $aParts['z2'] < $aParts['z1'] OR
    				$aParts['x2'] > $this->N OR $aParts['y2'] > $this->N OR $aParts['z2'] > $this->N) {
    				return false;
    			}
    			break;

    		case 'UPDATE':
    			if ($aParts['x1'] < 1 OR $aParts['y1'] < 1 OR $aParts['z1'] < 1 OR
    				$aParts['x1'] > $this->N OR $aParts['y1'] > $this->N OR $aParts['z1'] > $this->N) {
    				return false;
    			}
    			break;

    		default:
    			return false;
    	}

    	return true;
    }

    //Validacion #4 - Valor del bloque
    private function blockValueValidation() {
        $oQuery = new QueryProcessingClass();
        $aParts = $oQuery->queryToArray($this->query);

        if($aParts['tipo'] === 'UPDATE') {
            $limitW = pow(10, 9);
            if($aParts['W'] < -$limitW OR $aParts['W'] > $limitW) {
                return false;
            }
        }

        return true;
    }
}
