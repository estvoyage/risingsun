<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units
;

class error extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring\notEmpty')
		;
	}
}
