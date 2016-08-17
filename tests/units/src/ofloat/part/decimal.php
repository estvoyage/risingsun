<?php namespace estvoyage\risingsun\tests\units\ofloat\part;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class decimal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger\unsigned')
		;
	}
}
