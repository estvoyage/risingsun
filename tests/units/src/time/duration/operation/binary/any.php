<?php namespace estvoyage\risingsun\tests\units\time\duration\operation\binary;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ time as mockOfTime, ninteger as mockOfNInteger, ointeger as mockOfOInteger };

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
				$this->newTestedInstance($template = new mockOfOInteger, $operation = new mockOfNInteger\operation\binary),
				$firstOperand = new mockOfTime\duration,
				$secondOperand = new mockOfTime\duration,
				$recipient = new mockOfTime\duration\recipient
			)
			->if(
				$this->testedInstance->durationRecipientForOperationWithDurationAndDurationIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $operation))
				->mock($recipient)
					->receive('durationIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				},

				$this->calling($operation)->recipientOfOperationOnNIntegersIs = function($firstOperand, $secondOperand, $recipient) {
					(new comparison\unary\equal(1))
						->recipientOfComparisonWithOperandIs(
							$firstOperand,
							new comparison\recipient\functor\ok(
								function() use ($secondOperand, $recipient)
								{
									(new comparison\unary\equal(2))
										->recipientOfComparisonWithOperandIs(
											$secondOperand,
											new comparison\recipient\functor\ok(
												function() use ($recipient)
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

				$result = new mockOfTime\duration,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($result) {
					(new comparison\unary\equal(3))
						->recipientOfComparisonWithOperandIs(
							$ninteger,
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
			->if(
				$this->testedInstance->durationRecipientForOperationWithDurationAndDurationIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $operation))
				->mock($recipient)
					->receive('durationIs')
						->withArguments($result)
							->once
		;
	}
}
