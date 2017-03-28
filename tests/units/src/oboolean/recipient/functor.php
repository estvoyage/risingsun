<?php namespace estvoyage\risingsun\tests\units\oboolean\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\oboolean\recipient')
		;
	}

	function testOBooleanIs()
	{
		$this
			->given(
				$oboolean = new mockOfOBoolean,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $oboolean ])
		;
	}

}
