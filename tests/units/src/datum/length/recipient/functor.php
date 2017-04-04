<?php namespace estvoyage\risingsun\tests\units\datum\length\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\length\recipient')
		;
	}

	function testDatumLengthIs()
	{
		$this
			->given(
				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				},
				$length = new datum\length(rand(0, PHP_INT_MAX))
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->datumLengthIs($length))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $length ])
		;
	}
}
