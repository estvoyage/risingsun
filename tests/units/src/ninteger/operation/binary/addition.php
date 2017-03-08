<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ninteger\operation };
use mock\estvoyage\risingsun\ninteger as mockOfNInteger;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ninteger\operation\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new operation\controller\blackhole));
	}

	function testRecipientOfOperationWithNIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient,
				$this->newTestedInstance
			)
			->if(
				$firstOperand = 0,
				$secondOperand = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(0)
							->once

			->if(
				$firstOperand = 1,
				$secondOperand = 2
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(3)
							->once

			->if(
				$firstOperand = -1,
				$secondOperand = -2
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(-3)
							->once

			->given(
				$recipient = new mockOfNInteger\recipient,
				$controller = new mockOfNInteger\operation\controller,
				$this->newTestedInstance($controller)
			)
			->if(
				$firstOperand = PHP_INT_MAX,
				$secondOperand = 1
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithNIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($controller))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($controller)
					->receive('nintegerOperationGenerateOverflow')
						->once
		;
	}
}
