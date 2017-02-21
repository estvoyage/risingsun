<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class pow extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\unary')
		;
	}

	function testRecipientOfOperationOnOIntegerIs()
	{
		$this
			->given(
				$pow = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,
				$ointeger = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($pow)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($pow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$this->calling($pow)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($pow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($pow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$operation = new mockOfOInteger
			)
			->if(
				$this->calling($ointeger)->recipientOfOIntegerWithValueIs = function($value, $recipient) use ($operation) {
					oboolean\factory::areEquals($value, 9)
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $operation)
								{
									$recipient->ointegerIs($operation);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($pow))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($operation)
							->once
		;
	}
}
