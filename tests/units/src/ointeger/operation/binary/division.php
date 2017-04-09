<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ointeger as mockOfOInteger };

class division extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new block\blackhole));
	}

	function testRecipientOfOperationOnOIntegersIs()
	{
		$this
			->given(
				$divisionByZero = new mockOfBlock,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance($divisionByZero)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $ointegerWithNInteger) {
					$recipient->ointegerIs($ointegerWithNInteger);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = 0,
				$ointegerWithNInteger = new mockOfOInteger
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperandValue = 6,
				$secondOperandValue = 2,
				$ointegerWithNInteger = new mockOfOInteger
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($ointegerWithNInteger)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
				->mock($firstOperand)
					->receive('recipientOfOIntegerWithNIntegerIs')
						->withArguments(3)
							->once
		;
	}
}
