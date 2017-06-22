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
				$this->newTestedInstance($template = new mockOfOInteger, $noperation = new mockOfNInteger\operation\binary),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$firstOperandValue = rand(PHP_INT_MIN, PHP_INT_MAX),
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$secondOperandValue = rand(PHP_INT_MIN, PHP_INT_MAX),
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$operationValue = rand(PHP_INT_MIN, PHP_INT_MAX),
				$this->calling($noperation)->recipientOfOperationOnNIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($firstOperandValue, $secondOperandValue, $operationValue) {
					if ($firstOperand == $firstOperandValue && $secondOperand == $secondOperandValue)
					{
						$recipient->nintegerIs($operationValue);
					}
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$operation = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($operationValue, $operation) {
					if ($value == $operationValue)
					{
						$recipient->ointegerIs($operation);
					}
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $noperation))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($operation)
							->once
		;
	}
}
