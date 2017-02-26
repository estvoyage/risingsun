<?php namespace estvoyage\risingsun\tests\units\oboolean;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ block as mockOfBlock, oboolean as mockOfOBoolean };

class ko extends units\test
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
						->never
		;
	}

	function testBlockForFalseIs()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->blockForFalseIs($block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
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
						->withArguments(new oboolean\ok)
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

	function testRecipientOfComplementIs()
	{
		$this
			->given(
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfComplementIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once
		;
	}
}
