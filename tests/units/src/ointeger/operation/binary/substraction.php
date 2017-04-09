<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class substraction extends units\test
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

	function testRecipientOfOperationOnOIntegersAre()
	{
		$this
			->given(
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,
				$overflow = new mockOfBlock
			)

			->if(
				$this->newTestedInstance($overflow)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $firstOperandValue, & $secondOperandValue) {
					$recipient->ointegerIs(new ointeger\any($firstOperandValue - $secondOperandValue));
				}
			)

			->if(
				$firstOperandValue = PHP_INT_MIN,
				$secondOperandValue = PHP_INT_MAX
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperandValue = PHP_INT_MAX,
				$secondOperandValue = PHP_INT_MIN
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(0))
							->once

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(- $secondOperandValue))
							->once

			->if(
				$firstOperandValue = rand(1, PHP_INT_MAX),
				$secondOperandValue = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any($firstOperandValue))
							->once

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = rand(PHP_INT_MIN, -1)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(- $secondOperandValue))
							->once

			->if(
				$firstOperandValue = rand(PHP_INT_MIN, -1),
				$secondOperandValue = 0
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any($firstOperandValue))
							->once
		;
	}
}
