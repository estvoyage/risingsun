<?php namespace estvoyage\risingsun\tests\units\ofloat\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ofloat as mockOfOFloat;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\recipient')
		;
	}

	function testOFloatIs()
	{
		$this
			->given(
				$ofloat = new mockOfOFloat,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->ofloatIs($ofloat))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ofloat ])
		;
	}
}
