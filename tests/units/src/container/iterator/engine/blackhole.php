<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\container as mockOfContainer;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine')
		;
	}

	function testValuesForContainerIteratorPayloadIs()
	{
		$this
			->given(
				$payload = new mockOfContainer\iterator\payload,
				$value1 = uniqid(),
				$value2 = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$value3 = new \stdClass
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $value1, $value2, $value3))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
