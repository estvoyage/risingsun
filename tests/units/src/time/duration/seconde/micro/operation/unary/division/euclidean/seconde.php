<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro\operation\unary\division\euclidean;

require __DIR__ . '/../../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, ointeger };
use mock\estvoyage\risingsun\{ time as mockOfTime, ointeger as mockOfOInteger };

class seconde extends units\test
{
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
				$microAsOInteger = new mockOfOInteger,

				$this->calling($microAsOInteger)->recipientOfNIntegerIs = function($recipient) use (& $microValue) {
					$recipient->nintegerIs($microValue);
				},

				$this->calling($microAsOInteger)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $microValue) {
					$recipient->ointegerIs(new ointeger\any($microValue / 1000000));
				},

				$this->calling($micro)->recipientOfOIntegerIs = function($recipient) use ($microAsOInteger) {
					$recipient->ointegerIs($microAsOInteger);
				},

				$secondeInMicro = new mockOfTime\duration\seconde,

				$this->calling($seconde)->recipientOfSecondeWithOIntegerIs = function($ointeger, $recipient) use ($secondeInMicro, & $microValue) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($secondeInMicro, $recipient)
								{
									$recipient->secondeIs($secondeInMicro);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($ointeger, new ointeger\any($microValue / 1000000))
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
