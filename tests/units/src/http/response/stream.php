<?php namespace estvoyage\risingsun\tests\units\http\response;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class stream extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\response')
		;
	}

	function testOutputIs()
	{
		$this
			->given(
				$stream = new mockOfOutput\stream,
				$output = new mockOfOutput
			)
			->if(
				$this->newTestedInstance($stream)
			)
			->then
				->object($this->testedInstance->outputIs($output))
					->isEqualTo($this->newTestedInstance($stream))
				->mock($output)
					->receive('outputStreamIs')
						->withIdenticalArguments($stream)
							->once
		;
	}
}
