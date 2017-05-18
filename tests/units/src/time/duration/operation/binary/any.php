<?php namespace estvoyage\risingsun\tests\units\time\duration\operation\binary;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ time as mockOfTime, ninteger as mockOfNInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\operation\binary')
		;
	}

	function testDurationRecipientForOperationWithDurationAndDurationIs()
	{
		$this
			->given(
				$firstOperand = new mockOfTime\duration,
				$secondOperand = new mockOfTime\duration,
				$recipient = new mockOfTime\duration\recipient,
				$operation = new mockOfNInteger\operation\binary
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->durationRecipientForOperationWithDurationAndDurationIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('durationIs')
						->never

			->given(
				$result = new mockOfTime\duration
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				},
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				},
				$this->calling($operation)->recipientOfOperationOnNIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($result) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$firstOperand,
							1,
							new comparison\recipient\functor\ok(
								function() use ($secondOperand, $recipient, $result)
								{
									(new comparison\binary\equal)
										->recipientOfComparisonBetweenOperandAndReferenceIs(
											$secondOperand,
											2,
											new comparison\recipient\functor\ok(
												function() use ($recipient, $result)
												{
													$recipient->nintegerIs(3);
												}
											)
										)
									;
								}
							)
						)
					;
				},
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($result) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							3,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $result)
								{
									$recipient->ointegerIs($result);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->durationRecipientForOperationWithDurationAndDurationIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('durationIs')
						->withArguments($result)
							->once
		;
	}
}
