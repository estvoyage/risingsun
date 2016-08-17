<?php

namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$callable = function() use (& $arguments) { $arguments = func_get_args(); }
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEmpty

			->if(
				$argument1 = uniqid(),
				$argument2 = uniqid(),
				$argument3 = uniqid()
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($argument1, $argument2, $argument3))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isIdenticalTo([ $argument1, $argument2, $argument3 ])
		;
	}
}
