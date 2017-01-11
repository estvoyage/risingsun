<?php namespace estvoyage\risingsun\tests\units\time\second;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class micro extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger')
		;
	}
}
