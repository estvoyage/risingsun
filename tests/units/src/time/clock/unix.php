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
				$template = new mockOfUnix\micro,
				$recipient = new mockOfUnix\micro\recipient,
				$now = M_PI
			)
			->if(
				$this->function->microtime = $now,
				$this->newTestedInstance($template)
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never
				->function('microtime')
					->wasCalledWithArguments(true)
						->once
				->mock($template)
					->receive('recipientOfMicroUnixTimestampWithNFloatIs')
						->withArguments($now)
							->once

			->given(
				$timestamp = new mockOfUnix\micro
			)
			->if(
				$this->calling($template)->recipientOfMicroUnixTimestampWithNFloatIs = function($nfloat, $recipient) use ($timestamp) {
					$recipient->microUnixTimestampIs($timestamp);
				}
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($timestamp)
							->once
				->function('microtime')
					->wasCalledWithArguments(true)
						->twice
				->mock($template)
					->receive('recipientOfMicroUnixTimestampWithNFloatIs')
						->withArguments($now)
							->twice
		;
	}
}
