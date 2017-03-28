<?php namespace estvoyage\risingsun\tests\units\time\clock;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, time\duration\timestamp };
use mock\estvoyage\risingsun\{ time\duration\timestamp\unix as mockOfUnix, ofloat as mockOfOFloat };

class unix extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\clock')
		;
	}

	function testRecipientOfMicroUnixTimestampIs()
	{
		$this
			->given(
				$operation = new mockOfOFloat\operation\unary,
				$recipient = new mockOfUnix\micro\recipient,
				$now = M_PI
			)
			->if(
				$this->function->microtime = $now,
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never
				->function('microtime')
					->wasCalledWithArguments(true)
						->once
				->mock($operation)
					->receive('recipientOfOperationWithOFloatIs')
						->withArguments(new timestamp\unix\micro($now))
							->once

			->given(
				$timestamp = new mockOfUnix\micro
			)
			->if(
				$this->calling($operation)->recipientOfOperationWithOFloatIs = function($operand, $recipient) use ($timestamp) {
					$recipient->ofloatIs($timestamp);
				}
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($timestamp)
							->once
				->function('microtime')
					->wasCalledWithArguments(true)
						->twice
				->mock($operation)
					->receive('recipientOfOperationWithOFloatIs')
						->withArguments(new timestamp\unix\micro($now))
							->twice
		;
	}
}
