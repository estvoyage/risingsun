<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\unary')
		;
	}

	function testRecipientOfOperationWithOIntegerIs()
	{
		$this
			->given(
				$this->newTestedInstance($secondOperand = new mockOfOInteger, $operation = new mockOfOInteger\operation\binary),
				$firstOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($firstOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($secondOperand, $operation))
				->mock($operation)
					->receive('recipientOfOperationOnOIntegersIs')
						->withArguments($firstOperand, $secondOperand, $recipient)
							->once
		;
	}
}
