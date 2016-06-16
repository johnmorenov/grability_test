<?php

namespace App\Classes;

class QueryProcessingClass
{
	public function queryToArray($query) {
		$aParts = array();

		$aPartsFinal = array(
			'tipo' => '',
			'x1' => 0,
			'y1' => 0,
			'z1' => 0,
			'x2' => 0,
			'y2' => 0,
			'z2' => 0,
			'W' => 0
		);

		if (!empty($query)) {
			$query = preg_replace('/\s+/', ' ', trim($query));
			$aParts = explode(' ', $query);

			if (is_string($aParts[0])) {
				$aParts[0] = strtoupper($aParts[0]);
			}

			switch ($aParts[0]) {
				case 'QUERY':
					$aPartsFinal['tipo'] = $aParts[0];
					$aPartsFinal['x1'] = (int) $aParts[1];
					$aPartsFinal['y1'] = (int) $aParts[2];
					$aPartsFinal['z1'] = (int) $aParts[3];
					$aPartsFinal['x2'] = (int) $aParts[4];
					$aPartsFinal['y2'] = (int) $aParts[5];
					$aPartsFinal['z2'] = (int) $aParts[6];
					break;
				
				case 'UPDATE':
					$aPartsFinal['tipo'] = $aParts[0];
					$aPartsFinal['x1'] = (int) $aParts[1];
					$aPartsFinal['y1'] = (int) $aParts[2];
					$aPartsFinal['z1'] = (int) $aParts[3];
					$aPartsFinal['W']  = (float) $aParts[4];
					break;
			}
		}

		return $aPartsFinal;
	}
}