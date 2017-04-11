<?php namespace estvoyage\risingsun\tests\units\bench;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, time, block };
use mock\estvoyage\risingsun\{ time as mockOfTime, block as mockOfBlock };

class micro extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\bench')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new time\clock\timestamp\unix\micro));
	}

	function testRecipientOfDurationForBlockIs()
	{
		$this
			->given(
				$clock = new mockOfTime\clock,
				$block = new mockOfBlock,
				$recipient = new mockOfTime\duration\recipient
			)
			->if(
				$this->newTestedInstance($clock)
			)
			->then
				->object($this->testedInstance->recipientOfDurationForBlockIs($block, $recipient))
					->isEqualTo($this->newTestedInstance($clock))
				->mock($recipient)
					->receive('durationIs')
						->never

			->given(
				$start = new mockOfTime\duration\timestamp\unix\micro,
				$stop = new mockOfTime\duration\timestamp\unix\micro,
				$duration = new mockOfTime\duration\timestamp\unix\micro
			)
			->if(
				$this->calling($clock)->recipientOfMicroUnixTimestampIs[2] = function($recipient) use ($start) {
					$recipient->microUnixTimestampIs($start);
				},
				$this->calling($clock)->recipientOfMicroUnixTimestampIs[3] = function($recipient) use ($stop) {
					$recipient->microUnixTimestampIs($stop);
				},
				$this->calling($start)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				},
				$this->calling($stop)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				},
				$this->calling($stop)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($duration) {
					(
						new comparison\binary\equal
						(
							new block\functor(
								function() use ($recipient, $duration)
								{
									$recipient->ointegerIs($duration);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs(
							$ninteger,
							1
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDurationForBlockIs($block, $recipient))
					->isEqualTo($this->newTestedInstance($clock))
				->mock($recipient)
					->receive('durationIs')
						->withArguments($duration)
							->once
		;
	}
}
