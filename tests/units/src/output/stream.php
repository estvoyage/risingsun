<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class stream extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring')
		;
	}

	function testRecipientOfOutputStreamWithIteratorContentsAsSuffixIs()
	{
		$this
			->given(
				$value = 'foo',

				$iteratorStream = $this->newTestedInstance('bar'),
				$iterator = new mockOfOutput\stream\iterator,
				$this->calling($iterator)->recipientOfOutputStreamIs = function($recipient) use ($iteratorStream) {
					$recipient->outputStreamIs($iteratorStream);
				},

				$recipient = new mockOfOutput\stream\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfOutputStreamWithIteratorContentsAsSuffixIs($iterator, $recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('outputStreamIs')
						->withArguments($this->newTestedInstance('foobar'))
							->once
		;
	}
}
