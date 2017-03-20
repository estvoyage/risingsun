<?php namespace estvoyage\risingsun\tests\units\ofloat\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ofloat as mockOfOFloat;

class substraction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\operation\binary')
		;
	}

	function testRecipientOfOperationOnOFloatIs()
	{
		$this
			->given(
				$firstOperand = new mockOfOFloat,
				$secondOperand = new mockOfOFloat,
				$recipient = new mockOfOFloat\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatIs')
						->never

			->given(
				$firstOperandValue = 3.2,
				$secondOperandValue = 1.2,
				$ofloat = new mockOfOFloat
			)
			->if(
				$this->calling($firstOperand)->recipientOfNFloatIs = function($recipient) use ($firstOperandValue) {
					$recipient->nfloatIs($firstOperandValue);
				},
				$this->calling($firstOperand)->recipientOfOFloatWithNFloatIs = function($nfloat, $recipient) use ($ofloat) {
					$recipient->ofloatIs($ofloat);
				},
				$this->calling($secondOperand)->recipientOfNFloatIs = function($recipient) use ($secondOperandValue) {
					$recipient->nfloatIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments($ofloat)
							->once
				->mock($firstOperand)
					->receive('recipientOfOFloatWithNFloatIs')
						->withArguments(2.)
							->once
		;
	}
}
