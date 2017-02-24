<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class greaterThanOrEqualTo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}
}
