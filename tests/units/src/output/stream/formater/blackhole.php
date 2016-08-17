<?php namespace estvoyage\risingsun\tests\units\output\stream\formater;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\formater')
		;
	}

	function testOutputIs()
	{
		$this->object($this->newTestedInstance->outputIs(new mockOfOutput))->isTestedInstance;
	}
}
