<?php namespace estvoyage\risingsun\tests\units\ofloat\part\decimal\recipient;

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
			->implements('estvoyage\risingsun\ofloat\part\decimal\recipient')
		;
	}

	function testDecimalPartIs()
	{
		$this->object($this->newTestedInstance->decimalPartIs(new mockOfOfloat\part\decimal))->isTestedInstance;
	}
}
