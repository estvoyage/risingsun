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
				$this->newTestedInstance($template = new mockOfTimestamp),
				$firstOperand = new mockOfTimestamp,
				$secondOperand = new mockOfTimestamp,
				$recipient = new mockOfTimestamp\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				},

				$microUnixTimestamp = new mockOfTimestamp,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($microUnixTimestamp) {
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
			->if(
				$this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($microUnixTimestamp)
							->once
		;
	}
}
