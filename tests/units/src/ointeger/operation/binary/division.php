<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ointeger as mockOfOInteger };

class division extends units\test
{
	use units\providers\ninteger\operation\division { units\providers\ninteger\operation\division::operandsProvider as nintegersProvider; }

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

	/**
	 * @dataProvider nintegersProvider
	 */
	function testRecipientOfOperationOnOIntegersIs($firstOperandValue, $secondOperandValue, $divisionValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $divisionByZero = new mockOfBlock),

				$division = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($divisionValue, $division) {
					(new comparison\unary\equal($divisionValue))
						->recipientOfComparisonWithOperandIs(
							$ninteger,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $division)
								{
									$recipient->ointegerIs($division);
								}
							)
						)
					;
				},

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

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
						->withArguments($division)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->never
		;
	}

	function testRecipientOfOperationOnOIntegersIs_withZeroAsDivisor()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $divisionByZero = new mockOfBlock),

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use (& $ointegerWithNInteger) {
					$recipient->ointegerIs($ointegerWithNInteger);
				},

				$firstOperand = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(rand(PHP_INT_MIN, PHP_INT_MAX));
				},


				$secondOperand = new mockOfOInteger,
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(0);
				},

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
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
