<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison;

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison };

abstract class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function testRecipientOfOFloatComparisonBetweenOFloatIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$oOperand = new mockOfOFloat,
				$oReference = new mockOfOFloat,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfOFloatComparisonBetweenOperandAndReferenceIs($oOperand, $oReference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->never
		;
	}

	/**
	 * @dataProvider provider
	 */
	function testRecipientOfOFloatComparisonBetweenOFloatIs_BooleanForOperandAndReferenceIs($operand, $reference, $boolean)
	{
		$this
			->given(
				$this->newTestedInstance,

				$oOperand = new mockOfOFloat,
				$this->calling($oOperand)->recipientOfNFloatIs = function($recipient) use ($operand) {
					$recipient->nfloatIs($operand);
				},

				$oReference = new mockOfOFloat,
				$this->calling($oReference)->recipientOfNFloatIs = function($recipient) use ($reference) {
					$recipient->nfloatIs($reference);
				},

				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfOFloatComparisonBetweenOperandAndReferenceIs($oOperand, $oReference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments($boolean)
							->once
		;
	}

	protected abstract function provider();
}
