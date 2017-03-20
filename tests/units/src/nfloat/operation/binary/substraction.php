<?php namespace estvoyage\risingsun\tests\units\nfloat\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\nfloat as mockOfNFloat;

class substraction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\nfloat\operation\binary')
		;
	}

	function testRecipientOfOperationOnNFloatIs()
	{
		$this
			->given(
				$recipient = new mockOfNFloat\recipient,
				$this->newTestedInstance
			)
			->if(
				$firstOperand = 0,
				$secondOperand = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nfloatIs')
						->withArguments(0)
							->once

			->if(
				$firstOperand = 1.,
				$secondOperand = 1.
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nfloatIs')
						->withArguments(0)
							->twice
		;
	}
}
