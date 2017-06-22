<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\recipient;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\time as mockOfTime;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\seconde\recipient')
		;
	}

	function testSecondeIs()
	{
		$this
			->given(
				$seconde = new mockOfTime\duration\seconde,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)->secondeIs($seconde)
			)
			->then
				->array($arguments)
					->isEqualTo([ $seconde ])
		;
	}
}
