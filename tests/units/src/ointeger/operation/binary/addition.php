<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class addition extends units\test
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
					$recipient->ointegerIs(new ointeger\any($firstOperandValue + $secondOperandValue));
				}
			)
			->if(
				$firstOperandValue = PHP_INT_MAX,
				$secondOperandValue = 1,
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
				$firstOperandValue = 1,
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
						->twice

			->if(
				$firstOperandValue = PHP_INT_MIN,
				$secondOperandValue = -1,
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
						->thrice

			->if(
				$firstOperandValue = -1,
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
						->{4}

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->{4}

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
						->withArguments(new ointeger\any($secondOperandValue))
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->{4}

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->{4}

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
						->withArguments(new ointeger\any($secondOperandValue))
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->{4}

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->{4}
		;
	}
}
