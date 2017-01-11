<?php namespace estvoyage\risingsun\tests\units\time\duration\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ output as mockOfOutput, time as mockOfTime };

class output extends units\test
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
				$output = new mockOfOutput,
				$formater = new mockOfOutput\formater\duration,
				$duration = new mockOfTime\duration
			)
			->if(
				$this->newTestedInstance($output, $formater)
			)
			->then
				->object($this->testedInstance->durationIs($duration))
					->isEqualTo($this->newTestedInstance($output, $formater))
				->mock($formater)
					->receive('outputForDurationIs')
						->withArguments($duration, $output)
							->once
		;
	}
}
