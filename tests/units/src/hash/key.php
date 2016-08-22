<?php namespace estvoyage\risingsun\tests\units\hash;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class key extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring\notEmpty')
		;
	}
}
