<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\operation\binary;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, time\duration\timestamp\unix\micro as mockOfTimestamp };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary')
		;
	}

	function testRecipientOfOperationOnMicroUnixTimestampsIs()
	{
		$this
			->given(
				$operation = new mockOfNInteger\operation\binary,
				$firstOperand = new mockOfTimestamp,
				$secondOperand = new mockOfTimestamp,
				$recipient = new mockOfTimestamp\recipient
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->if(
				$this->calling($operation)->recipientOfOperationOnNIntegersIs = function($firstOperand, $secondOperand, $recipient) {
					$recipient->nintegerIs(3);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$timestamp = new mockOfTimestamp
			)
			->if(
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($timestamp) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							3,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $timestamp)
								{
									$recipient->ointegerIs($timestamp);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($timestamp)
							->once
		;
	}
}
