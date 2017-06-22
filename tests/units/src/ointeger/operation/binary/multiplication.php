<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, comparison };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ointeger as mockOfOInteger };

class multiplication extends units\test
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

	function testRecipientOfOperationOnOIntegersIs_withNoMessage()
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

	/**
	 * @dataProvider validOperandsProvider
	 */
	function testRecipientOfOperationOnOIntegersIs($firstOperandValue, $secondOperandValue, $addition)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$ointegerWithNInteger = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($addition, $ointegerWithNInteger) {
					(new comparison\unary\equal($addition))
						->recipientOfComparisonWithOperandIs(
							$ninteger,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $ointegerWithNInteger)
								{
									$recipient->ointegerIs($ointegerWithNInteger);
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
						->withArguments($ointegerWithNInteger)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider overflowProvider
	 */
	function testRecipientOfOperationOnOIntegersIs_withOverflow($firstOperandValue, $secondOperandValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) {
					$recipient->ointegerIs(new mockOfOInteger);
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

	protected function validOperandsProvider()
	{
		return [
			[ 0, 0, 0 ],
			[ rand(PHP_INT_MIN, PHP_INT_MAX), 0, 0 ],
			[ 0, rand(PHP_INT_MIN, PHP_INT_MAX), 0 ],
			[ 0, rand(PHP_INT_MIN, PHP_INT_MAX), 0 ],
			[ PHP_INT_MIN, 1, PHP_INT_MIN ],
			[ 1, PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, 1, PHP_INT_MAX ],
			[ 1, PHP_INT_MAX, PHP_INT_MAX ],
			[ 2, 3, 6 ],
			[ 3, 2, 6 ],
			[ -2, -3, 6 ],
			[ -2, 3, -6 ],
			[ 3, -2, -6 ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ PHP_INT_MAX, 2 ],
			[ 2, PHP_INT_MAX ],
			[ PHP_INT_MIN, 2 ],
			[ 2, PHP_INT_MIN ]
		];
	}
}
