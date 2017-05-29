<?php namespace estvoyage\risingsun\tests\units\datum\finder\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\finder\recipient')
		;
	}

	function testDatumIsAtPosition()
	{
		$this
			->given(
				$position = new mockOfOInteger,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->datumIsAtPosition($position))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $position ])
		;
	}
}
