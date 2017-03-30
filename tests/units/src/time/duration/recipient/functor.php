<?php namespace estvoyage\risingsun\tests\units\time\duration\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\time\duration as mockOfDuration;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\recipient')
		;
	}

	function testDurationIs()
	{
		$this
			->given(
				$duration = new mockOfDuration,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->durationIs($duration))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $duration ])
		;
	}
}
