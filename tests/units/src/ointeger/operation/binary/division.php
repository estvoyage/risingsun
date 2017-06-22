<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, ointeger };
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
		$this
			->given(
				$template = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($template)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, new block\blackhole))
		;
	}

	function testRecipientOfOperationOnOIntegersIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $divisionByZero = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $ointegerWithNInteger) {
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
					->isEqualTo($this->newTestedInstance($template, $divisionByZero))
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
					->isEqualTo($this->newTestedInstance($template, $divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($ointegerWithNInteger)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
				->mock($template)
					->receive('recipientOfOIntegerWithNIntegerIs')
						->withArguments(3)
							->once
		;
	}
}
