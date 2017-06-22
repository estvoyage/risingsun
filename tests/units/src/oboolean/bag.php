<?php namespace estvoyage\risingsun\tests\units\oboolean;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, oboolean as mockOfOBoolean };

class bag extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\oboolean')
		;
	}

	function testRecipientOfNBooelanIs()
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient,
				$this->newTestedInstance
			)
			->if(
				$this->testedInstance->recipientOfNBooleanIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->never

			->given(
				$this->newTestedInstance(false)
			)
			->if(
				$this->testedInstance->recipientOfNBooleanIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(false))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once

			->given(
				$this->newTestedInstance(true)
			)
			->if(
				$this->testedInstance->recipientOfNBooleanIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(true))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}

	function testRecipientOfOBooleanWithNBooleanIs()
	{
		$this
			->given(
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfOBooleanWithNBooleanIs(false, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(false))
							->once

			->if(
				$this->newTestedInstance(false)->recipientOfOBooleanWithNBooleanIs(false, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(false))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(false))
							->twice

			->if(
				$this->newTestedInstance(true)->recipientOfOBooleanWithNBooleanIs(false, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(true))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(false))
							->thrice

			->if(
				$this->newTestedInstance->recipientOfOBooleanWithNBooleanIs(true, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(true))
							->once

			->if(
				$this->newTestedInstance(false)->recipientOfOBooleanWithNBooleanIs(true, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(true))
							->twice

			->if(
				$this->newTestedInstance(true)->recipientOfOBooleanWithNBooleanIs(true, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(true))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($this->newTestedInstance(true))
							->thrice

			->if(
				(new childOfTestedClass)->recipientOfOBooleanWithNBooleanIs(true, $recipient)
			)
			->then
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new childOfTestedClass(true))
							->once
		;
	}
}

class childOfTestedClass extends oboolean\bag
{
}
