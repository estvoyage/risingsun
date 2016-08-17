<?php namespace estvoyage\risingsun\tests\units\output\stream\formater;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\output,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class stream extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\formater')
		;
	}

	function testOutputIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$stream = new output\stream(uniqid())
			)
			->if(
				$this->newTestedInstance($stream)
			)
			->then
				->object($this->testedInstance->outputIs($output))->isTestedInstance
				->mock($output)
					->receive('outputStreamIs')
						->withIdenticalArguments($stream)
							->once
		;
	}
}
