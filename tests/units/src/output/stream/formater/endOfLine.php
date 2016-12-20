<?php namespace estvoyage\risingsun\tests\units\output\stream\formater;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\output,
	estvoyage\risingsun\ostring,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class endOfLine extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\formater')
		;
	}

	function testRecipientOfStreamWithEndOfLineIs()
	{
		$this
			->given(
				$streamWithEol = new mockOfOutput\stream,

				$stream = new mockOfOutput\stream,
				$this->calling($stream)->recipientOfStringWithSuffixIs = function($suffix, $recipient) use ($streamWithEol) {
					oboolean::isEqual($suffix, new ostring\notEmpty(PHP_EOL))
						->ifTrue(
							new block\functor(
								function() use ($recipient, $streamWithEol)
								{
									$recipient->ostringIs($streamWithEol);
								}
							)
						)
					;
				},

				$recipient = new mockOfOutput\stream\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOutputStreamWithEndOfLineIs($stream, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('outputStreamIs')
						->withIdenticalArguments($streamWithEol)
							->once
		;
	}
}
