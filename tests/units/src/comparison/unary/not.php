<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class not extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function testRecipientOfComparisonWithOperandIs()
	{
		$this
			->given(
				$this->newTestedInstance($comparison = new mockOfComparison\unary),
				$operand = uniqid(),
				$recipient = new mockOfComparison\recipient
			)

			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->never

			->given(
				$this->calling($comparison)->recipientOfComparisonWithOperandIs = function($anOperand, $recipient) use ($operand) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOperand,
							$operand,
							new comparison\recipient\functor\ok(
								function() use ($recipient)
								{
									$recipient->nbooleanIs(true);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once

			->given(
				$this->calling($comparison)->recipientOfComparisonWithOperandIs = function($anOperand, $recipient) use ($operand) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOperand,
							$operand,
							new comparison\recipient\functor\ok(
								function() use ($recipient)
								{
									$recipient->nbooleanIs(false);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}
}
