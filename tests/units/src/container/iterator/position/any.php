<?php namespace estvoyage\risingsun\tests\units\container\iterator\position;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\position')
		;
	}
}
