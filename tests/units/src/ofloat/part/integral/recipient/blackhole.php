<?php namespace estvoyage\risingsun\tests\units\ofloat\part\integral\recipient;

require __DIR__ . '/../../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\ofloat as mockOfOfloat
;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\part\integral\recipient')
		;
	}

	function testIntegralPartIs()
	{
		$this->object($this->newTestedInstance->integralPartIs(new mockOfOfloat\part\integral))->isTestedInstance;
	}
}
