<?php namespace estvoyage\risingsun\tests\units\datum\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\datum as mockOfDatum;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\recipient')
		;
	}

	function testDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->datumIs($datum))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $datum ])
		;
	}
}
