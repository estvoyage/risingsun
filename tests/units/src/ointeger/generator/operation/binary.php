<?php namespace estvoyage\risingsun\tests\units\ointeger\generator\operation;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean\factory, block\functor };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\generator')
		;
	}

	function testRecipientOfOIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfOInteger\recipient,
				$start = new mockOfOInteger,
				$otherInteger = new mockOfOInteger,
				$operation = new mockOfOInteger\operation\binary
			)
			->if(
				$this->newTestedInstance($start, $otherInteger, $operation)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($start, $otherInteger, $operation))
				->mock($start)
					->receive('recipientOfOperationWithOIntegerIs')
						->withIdenticalArguments($operation, $otherInteger, $recipient)
							->never

			->given(
				$nextInteger = new mockOfOInteger,
				$nextInteger->id = uniqid()
			)
			->if(
				$this->calling($start)->recipientOfOperationWithOIntegerIs = function($anOperation, $secondOperand, $recipient) use ($operation, $otherInteger, $nextInteger) {
					factory::areEquals($anOperation, $operation)
						->blockForTrueIs(
							new functor(
								function() use ($secondOperand, $recipient, $otherInteger, $nextInteger)
								{
									factory::areEquals($secondOperand, $otherInteger)
										->blockForTrueIs(
											new functor(
												function() use ($recipient, $nextInteger)
												{
													$recipient->ointegerIs($nextInteger);
												}
											)
										)
									;
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($nextInteger, $otherInteger, $operation))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($start)
							->once
		;
	}
}
