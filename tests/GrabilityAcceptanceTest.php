<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GrabilityAcceptanceTest extends TestCase
{
    /**
     * Prueba para la pagina principal.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')
        	 ->see('CUBE SUMMATION')
        	 ->see('Cube dimensions');
    }

    /**
     * Prueba para la pagina de Operaciones (operations).
     *
     * @return void
     */
    public function testOperationsPage()
    {
        $this->visit('/')
        	 ->type('4', 'cubeDimensions')
        	 ->press('btnGO')
        	 ->seePageIs('/operations')
        	 ->see('CUBE SUMMATION')
        	 ->see('CUBE Query')
        	 ->type('QUERY 1 1 1 4 4 4', 'query')
        	 ->press('btnRun')
        	 ->click('btnBack')
        	 ->seePageIs('/');
    }
}
