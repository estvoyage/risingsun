<?php namespace estvoyage\risingsun\tests\units\ointeger\ninteger\operation;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, ninteger as mockOfNInteger };

class binary extends units\test
{
	function testRecipientOfNIntegerIs()
	{
		$this
			->given(
				$ointeger1 = new mockOfOInteger,
				$ointeger2 = new mockOfOInteger,
				$operation = new mockOfNInteger\operation\binary,
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($ointeger1, $ointeger2, $operation)
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2, $operation))
				->mock($recipient)
					->receive('nintegerIs')
						->never

			->if(
				$this->calling($ointeger1)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2, $operation))
				->mock($recipient)
					->receive('nintegerIs')
						->never

			->if(
				$this->calling($ointeger2)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2, $operation))
				->mock($recipient)
					->receive('nintegerIs')
						->never

			->if(
				$this->calling($operation)->recipientOfOperationOnNIntegersIs = function($ninteger1, $ninteger2, $recipient) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($ninteger2, $recipient)
								{
									(
										new comparison\binary\equal(
											new block\functor(
												function() use ($recipient)
												{
													$recipient->nintegerIs(3);
												}
											)
										)
									)
										->referenceForComparisonWithOperandIs(
											$ninteger2,
											2
										)
									;
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs(
							$ninteger1,
							1
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2, $operation))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(3)
							->once
		;
	}
}
