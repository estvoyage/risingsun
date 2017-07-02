<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, block as mockOfBlock };

class pow extends units\ninteger\operation\binary
{
	use units\providers\ninteger\operation\pow;

	/**
	 * @dataProvider negativeExponentProvider
	 */
	function testRecipientOfOperationOnNIntegersIs_withNegativeExponent($firstOperand, $secondOperand)
	{
		$this
			->given(
				$this->newTestedInstance($overflow = new mockOfBlock),
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}
}
