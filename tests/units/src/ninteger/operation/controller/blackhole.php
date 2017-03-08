<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\controller;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ninteger\operation\controller')
		;
	}

	function testNIntgerOperationGenerateOverflow()
	{
		$this->object($this->newTestedInstance->nintegerOperationGenerateOverflow())->isEqualTo($this->newTestedInstance);
	}
}
