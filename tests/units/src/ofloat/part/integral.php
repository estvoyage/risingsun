<?php namespace estvoyage\risingsun\tests\units\ofloat\part;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class integral extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger')
		;
	}
}
