<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, time\duration\seconde };
use mock\estvoyage\risingsun\time as mockOfTime;

class any extends units\ointeger\any
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro')
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
						->withArguments(new seconde\any)
							->once

			->given(
				$this->newTestedInstance(1000000)
			)
			->if(
				$this->testedInstance->recipientOfNumberOfSecondeIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('secondeIs')
						->withArguments(new seconde\any(1))
							->once
		;
	}
}
