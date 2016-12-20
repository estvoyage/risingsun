<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class console extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function testOutputStreamIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$formater = new mockOfOutput\stream\formater,
				$stream = new mockOfOutput\stream
			)
			->if(
				$streamWithEol = new mockOfOutput\stream,

				$this->calling($formater)->recipientOfOutputStreamWithEndOfLineIs = function($stream, $recipient) use ($streamWithEol) {
					$recipient->outputStreamIs($streamWithEol);
				},

				$this->newTestedInstance($output, $formater)
			)
			->then
				->object($this->testedInstance->outputStreamIs($stream))
					->isEqualTo($this->newTestedInstance($output, $formater))
				->mock($output)
					->receive('outputStreamIs')
						->withIdenticalArguments($streamWithEol)
							->once
		;
	}
}
