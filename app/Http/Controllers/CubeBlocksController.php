<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;
use App\Cube;

class CubeBlocksController extends Controller
{
    /**
     * Get cube block values from CACHE (ex: DataBase)
     * @param int $N  (N*N*N)
     * @return matrix $aCube  Cube's block matrix
     */
	public static function cubeBlocks($N) {
        $aCube = array();
        $aCubeDB = Cube::all();

        for ($x = 1; $x <= $N; $x++) {
        	for ($y = 1; $y <= $N; $y++) {
        		for ($z = 1; $z <= $N; $z++) {
        			$aCube[$x][$y][$z] = 0;
        		}
        	}
        }

        foreach ($aCubeDB as $aBlocks) {
    		$aCube[$aBlocks['x1']][$aBlocks['y1']][$aBlocks['z1']] = (float) $aBlocks['W'];
        }

        return $aCube;
    }
}
