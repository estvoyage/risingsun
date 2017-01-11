<?php namespace estvoyage\risingsun\tests\units\bench;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ time as mockOfTime, bench as mockOfBench };

class micro extends units\test
{
	function testRecipientOfDurationForBlockIs()
	{
		$this
			->given(
				$duration = new mockOfTime\duration,

				$now1 = new mockOfTime\duration\unix\timestamp\micro,

				$now2 = new mockOfTime\duration\unix\timestamp\micro,
				$this->calling($now2)->recipientOfDifferenceWithMicroUnixTimestampIs = function($aTimestamp, $aRecipient) use ($duration) {
					$aRecipient->durationIs($duration);
				},

				$clock = new mockOfTime\clock,
				$this->calling($clock)->recipientOfMicroUnixTimestampIs[] = function($aRecipient) use ($now1) {
					$aRecipient->microUnixTimestampIs($now1);
				},
				$this->calling($clock)->recipientOfMicroUnixTimestampIs[] = function($aRecipient) use ($now2) {
					$aRecipient->microUnixTimestampIs($now2);
				},

				$block = new mockOfBench\block,
				$this->calling($block)->benchBlockControllerIs = function($aBench) {
					$aBench->endOfBenchBlock();
				},

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
						->withArguments($duration)
							->once
		;
	}
}
