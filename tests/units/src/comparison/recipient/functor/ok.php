<?php namespace estvoyage\risingsun\tests\units\comparison\recipient\functor;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class ok extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testNBooleanIs()
	{
		$this
			->given(
				$this->newTestedInstance($callable = function() use (& $arguments) { $arguments = func_get_args(); })
			)

			->if(
				$this->testedInstance->nbooleanIs(false)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($callable))
				->variable($arguments)
					->isNull

			->if(
				$this->testedInstance->nbooleanIs(true)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEmpty
		;
	}
}
