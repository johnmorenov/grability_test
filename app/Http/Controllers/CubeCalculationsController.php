<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;

use App\Http\Controllers\CubeBlocksController;

class CubeCalculationsController extends Controller
{
    /**
     * Cube summation calculation
     * @param int $N  (N*N*N)
     * @param array $aParts  Parts or parameters of the query string
     * @return int $blocksSum  Sum of Cube's blocks
     */
	public static function cubeSummation($N, $aParts) {
        $blocksSum = 0;

        if(isset($aParts['x2']) AND isset($aParts['y2']) AND isset($aParts['z2'])) {
            $aCube = CubeBlocksController::cubeBlocks($N);
            
            for ($x = $aParts['x1']; $x <= $aParts['x2']; $x++) {
                for ($y = $aParts['y1']; $y <= $aParts['y2']; $y++) {
                    for ($z = $aParts['z1']; $z <= $aParts['z2']; $z++) {
                        $blocksSum += $aCube[$x][$y][$z];
                    }
                }
            }
        }
        
        return $blocksSum;
    }
}
