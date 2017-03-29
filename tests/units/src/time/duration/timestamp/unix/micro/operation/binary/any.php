<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\operation\binary;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, time\duration\timestamp\unix\micro as mockOfTimestamp };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary')
		;
	}

	function testRecipientOfOperationOnMicroUnixTimestampsIs()
	{
		$this
			->given(
				$operation = new mockOfNFloat\operation\binary,
				$firstOperand = new mockOfTimestamp,
				$secondOperand = new mockOfTimestamp,
				$recipient = new mockOfTimestamp\recipient
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->never
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNFloatIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nfloatIs($firstOperandValue);
				}
			)
			->if(
				$firstOperandValue = 1.2
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->never
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$this->calling($secondOperand)->recipientOfNFloatIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nfloatIs($secondOperandValue);
				}
			)
			->if(
				$secondOperandValue = 3.6
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->withArguments($firstOperandValue, $secondOperandValue)
							->once
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$this->calling($operation)->recipientOfOperationOnNFloatsIs = function($firstOperand, $secondOperand, $recipient) use (& $operationValue) {
					$recipient->nfloatIs($operationValue);
				}
			)
			->if(
				$operationValue = M_PI
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->withArguments($firstOperandValue, $secondOperandValue)
							->twice
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfMicroUnixTimestampWithNFloatIs = function($float, $recipient) use (& $timestampFromFloat) {
					$recipient->microUnixTimestampIs($timestampFromFloat);
				}
			)
			->if(
				$timestampFromFloat = new mockOfTimestamp
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($operation)
					->receive('recipientOfOperationOnNFloatsIs')
						->withArguments($firstOperandValue, $secondOperandValue)
							->thrice
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($timestampFromFloat)
							->once
		;
	}
}
