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

	function testRecipientOfHttpResponseBodyIsOutput()
	{
		$this
			->given(
				$stream = new mockOfOutput\stream,
				$output = new mockOfOutput,
				$recipient = new mockOfOutput\recipient
			)
			->if(
				$this->newTestedInstance($stream)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseBodyIsOutput($output))
					->isEqualTo($this->newTestedInstance($stream))
				->mock($output)
					->receive('outputStreamIs')
						->withIdenticalArguments($stream)
							->once
		;
	}
}
