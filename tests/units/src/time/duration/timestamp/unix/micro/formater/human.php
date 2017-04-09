<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\formater;

require __DIR__ . '/../../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, time\duration\timestamp\unix as mockOfTimestamp };

class human extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro\formater')
		;
	}

	function testRecipientOfDatumForMicroUnixTimestampIs()
	{
		$this
			->given(
				$timestamp = new mockOfTimestamp\micro,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumForMicroUnixTimestampIs($timestamp, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}
}
