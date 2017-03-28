<?php namespace estvoyage\risingsun\tests\units\ointeger\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\recipient')
		;
	}

	function testOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->ointegerIs($ointeger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ointeger ])
		;
	}

}
