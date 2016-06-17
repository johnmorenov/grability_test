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
					$aPartsFinal['x1'] = (isset($aParts[1])) ? (int) $aParts[1] : 0;
					$aPartsFinal['y1'] = (isset($aParts[2])) ? (int) $aParts[2] : 0;
					$aPartsFinal['z1'] = (isset($aParts[3])) ? (int) $aParts[3] : 0;
					$aPartsFinal['x2'] = (isset($aParts[4])) ? (int) $aParts[4] : 0;
					$aPartsFinal['y2'] = (isset($aParts[5])) ? (int) $aParts[5] : 0;
					$aPartsFinal['z2'] = (isset($aParts[6])) ? (int) $aParts[6] : 0;
					break;
				
				case 'UPDATE':
					$aPartsFinal['tipo'] = $aParts[0];
					$aPartsFinal['x1'] = (isset($aParts[1])) ? (int) $aParts[1] : 0;
					$aPartsFinal['y1'] = (isset($aParts[2])) ? (int) $aParts[2] : 0;
					$aPartsFinal['z1'] = (isset($aParts[3])) ? (int) $aParts[3] : 0;
					$aPartsFinal['W']  = (isset($aParts[4])) ? (int) $aParts[4] : 0;
					break;
			}
		}

		return $aPartsFinal;
	}
}