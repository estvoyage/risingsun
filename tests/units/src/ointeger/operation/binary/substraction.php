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

	function testRecipientOfOperationOnOIntegersAre()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
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

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $firstOperandValue, & $secondOperandValue) {
					$recipient->ointegerIs(new ointeger\any($firstOperandValue - $secondOperandValue));
				}
			)

			->if(
				$firstOperandValue = PHP_INT_MIN,
				$secondOperandValue = PHP_INT_MAX,
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once

			->if(
				$firstOperandValue = PHP_INT_MAX,
				$secondOperandValue = PHP_INT_MIN,
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = 0,
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(0))
							->once

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = rand(1, PHP_INT_MAX),
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(- $secondOperandValue))
							->once

			->if(
				$firstOperandValue = rand(1, PHP_INT_MAX),
				$secondOperandValue = 0,
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any($firstOperandValue))
							->once

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = rand(PHP_INT_MIN, -1),
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any(- $secondOperandValue))
							->once

			->if(
				$firstOperandValue = rand(PHP_INT_MIN, -1),
				$secondOperandValue = 0,
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new ointeger\any($firstOperandValue))
							->once
		;
	}
}
