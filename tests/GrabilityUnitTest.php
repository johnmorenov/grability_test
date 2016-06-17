<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Classes\QueryProcessingClass;
use App\Http\Controllers\CubeBlocksController;
use App\Http\Controllers\CubeCalculationsController;
use App\Http\Controllers\queryValidationController;
use App\Http\Controllers\StoreDataController;

class GrabilityUnitTest extends TestCase
{
    /**
     * Prueba del procesado de consultas QUERY/UPDATE.
     *
     * @return void
     */
    public function testQueryProcessingClass()
    {
    	$oTest = new QueryProcessingClass();
    	$aTest1 = $oTest->queryToArray('Query 1 1 1 3 3 3');
    	$aTest2 = $oTest->queryToArray('Update 1 2 3 50');

        $this->assertEquals($aTest1['tipo'], 'QUERY');
        $this->assertEquals($aTest1['x1'], 1);
        $this->assertEquals($aTest1['y1'], 1);
        $this->assertEquals($aTest1['z1'], 1);
        $this->assertEquals($aTest1['x2'], 3);
        $this->assertEquals($aTest1['y2'], 3);
        $this->assertEquals($aTest1['z2'], 3);

        $this->assertEquals($aTest2['tipo'], 'UPDATE');
        $this->assertEquals($aTest2['x1'], 1);
        $this->assertEquals($aTest2['y1'], 2);
        $this->assertEquals($aTest2['z1'], 3);
        $this->assertEquals($aTest2['W'], 50);
    }

    /**
     * Prueba lectura de datos en cache (bloques del cubo).
     *
     * @return void
     */
    public function testCubeBlocksController()
    {
    	$this->assertInternalType('array', CubeBlocksController::cubeBlocks(50));
    }

    /**
     * Prueba de calculo de suma de bloques del cubo segun coordenadas.
     *
     * @return void
     */
    public function testCubeCalculationsController()
    {
    	$aParts = [
    		'x1' => 1,
    		'y1' => 1,
    		'z1' => 1,
    	];

    	$this->assertGreaterThanOrEqual(0, CubeCalculationsController::cubeSummation(3, $aParts));
    }

    /**
     * Prueba de validacion de consultas QUERY/UPDATE.
     *
     * @return void
     */
    public function testqueryValidationController()
    {
    	$oTest = new queryValidationController();
    	$oTest->setParameters(3, 'UPDATE 1 2 3 100');
    	$aTest = $oTest->initValidation();

    	$this->assertEquals(0, $aTest['errCod']);
    	$this->assertEmpty($aTest['errMsg']);
    	$this->assertSame('ok', $aTest['result']);
    }

    /**
     * Prueba de escritura en base de datos.
     * NOTA: debe existir una base de datos "grability" con una tabla "cube" (ver migrations) y tener configurado MySQL en .env.
     *
     * @return void
     */
    public function testStoreDataController()
    {
    	$aParts = [
    		'tipo' => 'UPDATE',
    		'x1' => 1,
    		'y1' => 1,
    		'z1' => 1,
    		'W' => 60
    	];

    	$this->assertNotEmpty(StoreDataController::storeData($aParts));
    }
}
