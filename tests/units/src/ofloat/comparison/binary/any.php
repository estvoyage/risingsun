<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function testRecipientOfOFloatComparisonBetweenOperandAndReferenceIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$operand = new mockOfOFloat,
				$reference = new mockOfOFloat,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenOperandAndReferenceIs')
						->never

			->given(
				$operandValue = 1.2
			)
			->if(
				$this->calling($operand)->recipientOfNFloatIs = function($recipient) use ($operandValue) {
					$recipient->nfloatIs($operandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenOperandAndReferenceIs')
						->never

			->given(
				$referenceValue = 8.5
			)
			->if(
				$this->calling($reference)->recipientOfNFloatIs = function($recipient) use ($referenceValue) {
					$recipient->nfloatIs($referenceValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenOperandAndReferenceIs')
						->withArguments($operandValue, $referenceValue, $recipient)
							->once
		;
	}
}
