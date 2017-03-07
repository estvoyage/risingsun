<?php namespace estvoyage\risingsun\tests\units\comparison\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class conjunction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testComparisonIsTrue()
	{
		$this
			->given(
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->comparisonIsTrue())
					->isEqualTo($this->newTestedInstance)
		;
	}

	function testComparisonIsFalse()
	{
		$this
			->given(
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->comparisonIsFalse())
					->isEqualTo($this->newTestedInstance)
		;
	}
}
