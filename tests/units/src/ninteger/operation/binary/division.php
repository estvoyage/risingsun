<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, block as mockOfBlock };

class division extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ninteger\operation\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new block\blackhole));
	}

	function testRecipientOfOperationOnNIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient,
				$divisionByZero = new mockOfBlock,
				$this->newTestedInstance($divisionByZero)
			)
			->if(
				$firstOperand = 0,
				$secondOperand = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperand = 2,
				$secondOperand = 1
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(2)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperand = 1,
				$secondOperand = 2
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(0)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperand = -2,
				$secondOperand = -1
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(2)
							->twice
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
