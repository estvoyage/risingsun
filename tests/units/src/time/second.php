<?php namespace estvoyage\risingsun\tests\units\time;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class second extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger')
		;
	}
}
