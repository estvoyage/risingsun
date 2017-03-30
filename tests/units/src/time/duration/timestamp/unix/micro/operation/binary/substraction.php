<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro\operation\binary;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, time\duration\timestamp\unix\micro as mockOfTimestamp };

class substraction extends units\test
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
				$firstOperand = new mockOfTimestamp,
				$secondOperand = new mockOfTimestamp,
				$recipient = new mockOfTimestamp\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$firstOperandValue = 3.2,
				$secondOperandValue = 1.2,
				$microUnixTimestamp = new mockOfTimestamp
			)
			->if(
				$this->calling($firstOperand)->recipientOfNFloatIs = function($recipient) use ($firstOperandValue) {
					$recipient->nfloatIs($firstOperandValue);
				},
				$this->calling($firstOperand)->recipientOfMicroUnixTimestampWithNFloatIs = function($nfloat, $recipient) use ($microUnixTimestamp) {
					$recipient->microUnixTimestampIs($microUnixTimestamp);
				},
				$this->calling($secondOperand)->recipientOfNFloatIs = function($recipient) use ($secondOperandValue) {
					$recipient->nfloatIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnMicroUnixTimestampsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($microUnixTimestamp)
							->once
				->mock($firstOperand)
					->receive('recipientOfMicroUnixTimestampWithNFloatIs')
						->withArguments(2.)
							->once
		;
	}
}
