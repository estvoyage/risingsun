<?php namespace estvoyage\risingsun\tests\units\ointeger\unsigned\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\unsigned\recipient')
		;
	}

	function testUnsignedOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger\unsigned,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->unsignedOIntegerIs($ointeger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ointeger ])
		;
	}
}
