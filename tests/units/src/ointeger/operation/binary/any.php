<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function testRecipientOfOperationOnOIntegersAre()
	{
		$this
			->given(
				$noperation = new mockOfNInteger\operation\binary,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance($noperation)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$firstOperandValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$secondOperandValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$operationValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->if(
				$this->calling($noperation)->recipientOfOperationOnNIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($firstOperandValue, $secondOperandValue, $operationValue) {
					if ($firstOperand == $firstOperandValue && $secondOperand == $secondOperandValue)
					{
						$recipient->nintegerIs($operationValue);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$operation = new mockOfOInteger
			)
			->if(
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($operationValue, $operation) {
					if ($value == $operationValue)
					{
						$recipient->ointegerIs($operation);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($operation)
							->once
		;
	}
}
