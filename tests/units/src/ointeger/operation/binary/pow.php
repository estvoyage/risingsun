<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class pow extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function testRecipientOfOperationsOnOIntegersIs()
	{
		$this
			->given(
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$firstOperandValue = 2
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$secondOperandValue = 3
			)
			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$pow = new mockOfOInteger
			)
			->if(
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($pow) {
					if ($value == 8)
					{
						$recipient->ointegerIs($pow);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($pow)
							->once

			->given(
				$recipient = new mockOfOInteger\recipient,
				$overflow = new mockOfBlock,
				$this->newTestedInstance($overflow)
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(PHP_INT_MAX);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->call('blockArgumentsAre')
						->once
		;
	}
}
