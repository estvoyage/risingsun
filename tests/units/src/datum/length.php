<?php namespace estvoyage\risingsun\tests\units\datum;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;

class length extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger\unsigned\any')
			->isFinal
		;
	}
}
