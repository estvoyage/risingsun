<?php namespace estvoyage\risingsun\tests\units\ointeger\generator\operation;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\generator')
		;
	}

	function testRecipientOfOIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfOInteger\recipient,
				$start = new mockOfOInteger,
				$otherInteger = new mockOfOInteger,
				$operation = new mockOfOInteger\operation\binary
			)
			->if(
				$this->newTestedInstance($start, $otherInteger, $operation)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($start, $otherInteger, $operation))
				->mock($operation)
					->receive('recipientOfOperationOnOIntegersIs')
						->withArguments($start, $otherInteger)
							->once

			->given(
				$nextInteger = new mockOfOInteger
			)
			->if(
				$this->calling($operation)->recipientOfOperationOnOIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($nextInteger) {
					$recipient->ointegerIs($nextInteger);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($nextInteger, $otherInteger, $operation))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($start)
							->once
		;
	}
}
