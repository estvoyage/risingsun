<?php namespace estvoyage\risingsun\tests\units\ointeger\operation;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

abstract class binary extends units\test
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

	function testRecipientOfOperationOnOIntegersAre_withAllOIntegerOperandsWithoutMessage()
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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	function testRecipientOfOperationOnOIntegersAre_withFirstOperandWithoutMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(rand(PHP_INT_MIN, PHP_INT_MAX));
				},

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	function testRecipientOfOperationOnOIntegersAre_withSecondOperandWithoutMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(rand(PHP_INT_MIN, PHP_INT_MAX));
				},

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider nIntegersProvider
	 */
	function testRecipientOfOperationOnOIntegersAre_withNIntegers($firstOperandValue, $secondOperandValue, $operationValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$operation = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($operationValue, $operation) {
					(new comparison\unary\equal($operationValue))
						->recipientOfComparisonWithOperandIs(
							$operationValue,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $operation)
								{
									$recipient->ointegerIs($operation);
								}
							)
						)
					;
				},

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
	function testRecipientOfOperationOnOIntegersAre_withOverflow($firstOperandValue, $secondOperandValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

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
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once
		;
	}

	abstract protected function nIntegersProvider();

	abstract protected function overflowProvider();
}
