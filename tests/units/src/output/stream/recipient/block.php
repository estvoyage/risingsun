<?php namespace estvoyage\risingsun\tests\units\output\stream\recipient;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\recipient')
		;
	}

	function testOutputStreamIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$stream = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->outputStreamIs($stream))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withIdenticalArguments($stream)
							->once
		;
	}
}
