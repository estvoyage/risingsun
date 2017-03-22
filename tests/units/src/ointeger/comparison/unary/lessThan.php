<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean, block as mockOfBlock };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function testWithNoArgument()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ointeger\any));
	}

	function testRecipientOfOIntegerComparisonWithOIntegerIs()
	{
		$this
			->given(
				$reference = new mockOfOInteger,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($reference)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$referenceValue = 0
			)
			->if(
				$this->calling($reference)->recipientOfNIntegerIs = function($recipient) use (& $referenceValue) {
					$recipient->nintegerIs($referenceValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$ointegerValue = 0
			)
			->if(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use (& $ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once

			->if(
				$ointegerValue = - rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once

			->if(
				$ointegerValue = rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->twice
		;
	}
}
