<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\operation\binary;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, time\duration\timestamp\unix\micro as mockOfTimestamp };

class substraction extends units\test
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
				$firstOperand = new mockOfTimestamp,
				$secondOperand = new mockOfTimestamp,
				$recipient = new mockOfTimestamp\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$microUnixTimestamp = new mockOfTimestamp
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				},
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				},
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($microUnixTimestamp) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							1,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $microUnixTimestamp)
								{
									$recipient->ointegerIs($microUnixTimestamp);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($microUnixTimestamp)
							->once
		;
	}
}
