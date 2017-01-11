<?php namespace estvoyage\risingsun\tests\units\time\duration\unix\timestamp\micro\recipient;

require __DIR__ . '/../../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ time as mockOfTime, block as mockOfBlock};

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\unix\timestamp\micro\recipient')
		;
	}

	function testMicroUnixTimestampIs()
	{
		$this
			->given(
				$timestamp = new mockOfTime\duration\unix\timestamp\micro,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->microUnixTimestampIs($timestamp))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($timestamp)
							->once
		;
	}
}
