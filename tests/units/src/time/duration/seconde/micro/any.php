<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, time as mockOfTime };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\seconde\micro')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	function testRecipientOfOIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($this->testedInstance)
							->once
		;
	}

	function testRecipientOfMicroSecondWithOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfTime\duration\seconde\micro\recipient
			)
			->if(
				$this->newTestedInstance(0)
			)
			->then
				->object($this->testedInstance->recipientOfMicroSecondeWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance(0))
				->mock($recipient)
					->receive('microSecondeIs')
						->never

			->given(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use (& $ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->if(
				$ointegerValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->recipientOfMicroSecondeWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance(0))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($this->newTestedInstance($ointegerValue))
							->once
		;
	}
}
