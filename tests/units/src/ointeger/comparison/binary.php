<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison;

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, comparison as mockOfComparison };

abstract class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function testRecipientOfOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$oOperand = new mockOfOInteger,
				$oReference = new mockOfOInteger,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs($oOperand, $oReference, $recipient)
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
	function testRecipientOfOIntegerComparisonBetweenOIntegerIs_BooleanForOperandAndReferenceIs($operand, $reference, $boolean)
	{
		$this
			->given(
				$this->newTestedInstance,

				$oOperand = new mockOfOInteger,
				$this->calling($oOperand)->recipientOfNIntegerIs = function($recipient) use ($operand) {
					$recipient->nintegerIs($operand);
				},

				$oReference = new mockOfOInteger,
				$this->calling($oReference)->recipientOfNIntegerIs = function($recipient) use ($reference) {
					$recipient->nintegerIs($reference);
				},

				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs($oOperand, $oReference, $recipient)
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
}
