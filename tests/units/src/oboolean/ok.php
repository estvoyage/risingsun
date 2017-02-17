<?php namespace estvoyage\risingsun\tests\units\oboolean;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ block as mockOfBlock, oboolean as mockOfOBoolean };

class ok extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\oboolean')
		;
	}

	function testBlockForTrueIs()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->blockForTrueIs($block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testRecipientOfObooleanWithValueIs()
	{
		$this
			->given(
				$value = true,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOBooleanWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->testedInstance)
							->once

			->if(
				$value = false
			)
			->then
				->object($this->testedInstance->recipientOfOBooleanWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once
		;
	}
}
