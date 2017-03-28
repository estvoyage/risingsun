<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\recipient;

require __DIR__ . '/../../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\time\duration\timestamp\unix as mockOfUnix;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro\recipient')
		;
	}

	function testMicroUnixTimestampIs()
	{
		$this
			->given(
				$micro = new mockOfUnix\micro,
				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->microUnixTimestampIs($micro))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $micro ])
		;
	}
}
