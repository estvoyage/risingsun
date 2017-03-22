<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean, comparison as mockOfComparison };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new comparison\binary\lessThan));
	}

	function testRecipientOfOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$lessThan = new mockOfComparison\binary\lessThan,
				$recipient = new mockOfOBoolean\recipient,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($lessThan)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($lessThan))
				->mock($lessThan)
					->receive('recipientOfComparisonBetweenValuesIs')
						->never

			->given(
				$firstOperandValue = rand(- PHP_INT_MAX, PHP_INT_MAX)
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($lessThan))
				->mock($lessThan)
					->receive('recipientOfComparisonBetweenValuesIs')
						->never

			->given(
				$secondOperandValue = rand(- PHP_INT_MAX, PHP_INT_MAX)
			)
			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($lessThan))
				->mock($lessThan)
					->receive('recipientOfComparisonBetweenValuesIs')
						->withArguments($firstOperandValue, $secondOperandValue, $recipient)
							->once
		;
	}
}
