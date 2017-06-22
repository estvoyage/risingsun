<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, time, comparison, block };
use mock\estvoyage\risingsun\time as mockOfTime;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\seconde')
		;
	}

	function testRecipientOfNumberOfSecondIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfTime\duration\seconde\recipient
			)
			->if(
				$this->testedInstance->recipientOfNumberOfSecondeIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('secondeIs')
						->withArguments($this->testedInstance)
							->once
		;
	}
}
