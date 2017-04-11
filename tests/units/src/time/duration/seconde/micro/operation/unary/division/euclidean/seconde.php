<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro\operation\unary\division\euclidean;

require __DIR__ . '/../../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, ointeger, time };
use mock\estvoyage\risingsun\{ time as mockOfTime, ointeger as mockOfOInteger };

class seconde extends units\test
{
	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new time\duration\seconde\any));
	}

	function testRecipientOfOperationWithMicroSecondIs()
	{
		$this
			->given(
				$seconde = new mockOfTime\duration\seconde,
				$recipient = new mockOfTime\duration\seconde\recipient,
				$micro = new mockOfTime\duration\seconde\micro
			)
			->if(
				$this->newTestedInstance($seconde)
			)
			->then
				->object($this->testedInstance->secondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('secondeIs')
						->never

			->given(
				$this->calling($micro)->recipientOfNIntegerIs = function($recipient) use (& $microValue) {
					$recipient->nintegerIs($microValue);
				},

				$secondeInMicro = new mockOfTime\duration\seconde,

				$this->calling($seconde)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($secondeInMicro, & $microValue) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($secondeInMicro, $recipient)
								{
									$recipient->ointegerIs($secondeInMicro);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($ninteger, $microValue / 1000000)
					;
				}
			)
			->if(
				$microValue = 0
			)
			->then
				->object($this->testedInstance->secondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('secondeIs')
						->withArguments($secondeInMicro)
							->once
		;
	}
}
