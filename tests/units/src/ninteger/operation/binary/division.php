<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, block as mockOfBlock };

class division extends units\test
{
	use units\providers\ninteger\operation\division;

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

	/**
	 * @dataProvider operandsProvider
	 */
	function testRecipientOfOperationOnNIntegerIs_withOperands($firstOperand, $secondOperand, $division)
	{
		$this
			->given(
				$this->newTestedInstance($divisionByZero = new mockOfBlock),
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments($division)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->never
		;
	}

	function testRecipientOfOperationOnNIntegerIs_withZeroAsDivisor()
	{
		$this
			->given(
				$this->newTestedInstance($divisionByZero = new mockOfBlock),
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnNIntegersIs(rand(PHP_INT_MIN, PHP_INT_MAX), 0, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
