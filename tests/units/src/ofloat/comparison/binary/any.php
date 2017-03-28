<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison, oboolean as mockOfOBoolean };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function testRecipientOfOFloatComparisonBetweenOFloatsIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$firstOperand = new mockOfOFloat,
				$secondOperand = new mockOfOFloat,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenValuesIs')
						->never

			->given(
				$firstOperandValue = 1.2
			)
			->if(
				$this->calling($firstOperand)->recipientOfNFloatIs = function($recipient) use ($firstOperandValue) {
					$recipient->nfloatIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenValuesIs')
						->never

			->given(
				$secondOperandValue = 8.5
			)
			->if(
				$this->calling($secondOperand)->recipientOfNFloatIs = function($recipient) use ($secondOperandValue) {
					$recipient->nfloatIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenValuesIs')
						->withArguments($firstOperandValue, $secondOperandValue, $recipient)
							->once
		;
	}
}
