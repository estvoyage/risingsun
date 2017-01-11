<?php namespace estvoyage\risingsun\tests\units\time\duration\unix\timestamp;

require __DIR__ . '/../../../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class micro extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ofloat\unsigned')
			->implements('estvoyage\risingsun\time\duration')
		;
	}
}
