<?php namespace estvoyage\risingsun\tests\units\ofloat\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, nfloat as mockOfNFloat };

class any extends units\test
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
				$recipient = new mockOfOFloat\recipient,
				$operation = new mockOfNFloat\operation\binary
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('ofloatIs')
						->never

			->given(
				$firstOperandValue = 1.2,
				$secondOperandValue = 6.3,
				$operationValue = 12.9,
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
				},
				$this->calling($operation)->recipientOfOperationOnNFloatsIs = function($firstOperand, $secondOperand, $recipient) use ($operationValue) {
					$recipient->nfloatIs($operationValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments($ofloat)
							->once
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->withArguments($firstOperandValue, $secondOperandValue)
							->once
				->mock($firstOperand)
					->receive('recipientOfOFloatWithNFloatIs')
						->withArguments($operationValue)
							->once
		;
	}
}
