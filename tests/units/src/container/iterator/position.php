<?php namespace estvoyage\risingsun\tests\units\container\iterator;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class position extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger')
		;
	}
}
