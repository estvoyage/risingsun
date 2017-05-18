<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class not extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
	}

	function testOkAndKoForComparisonBetweenOperandAndReferenceAre()
	{
		$this
			->given(
				$this->newTestedInstance($comparison = new mockOfComparison\binary),
				$operand = uniqid(),
				$reference = uniqid(),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->never

			->given(
				$this->calling($comparison)->recipientOfComparisonBetweenOperandAndReferenceIs = function($anOperand, $aReference, $recipient) use ($operand, $reference) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOperand,
							$operand,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $reference, $aReference)
								{
									(new comparison\binary\equal)
										->recipientOfComparisonBetweenOperandAndReferenceIs(
											$aReference,
											$reference,
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
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once

			->given(
				$this->calling($comparison)->recipientOfComparisonBetweenOperandAndReferenceIs = function($anOperand, $aReference, $recipient) use ($operand, $reference) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOperand,
							$operand,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $reference, $aReference)
								{
									(new comparison\binary\equal)
										->recipientOfComparisonBetweenOperandAndReferenceIs(
											$aReference,
											$reference,
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
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}
}
