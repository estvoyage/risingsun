<?php namespace estvoyage\risingsun\tests\units\ninteger\operation;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, block as mockOfBlock };

abstract class binary extends units\test
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

	/**
	 * @dataProvider operandsProvider
	 */
	function testRecipientOfOperationOnNIntegerIs_withOperands($firstOperand, $secondOperand, $operation)
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient,
				$overflow = new mockOfBlock,
				$this->newTestedInstance($overflow)
			)

			->if(
				$this->testedInstance->recipientOfOperationOnNIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments($operation)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider overflowProvider
	 */
	function testRecipientOfOperationOnNIntegerIs_withOverflow($firstOperand, $secondOperand)
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient,
				$overflow = new mockOfBlock,
				$this->newTestedInstance($overflow)
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
						->once
		;
	}

	abstract protected function operandsProvider();

	abstract protected function overflowProvider();
}
