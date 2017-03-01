<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class value extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function testConstructor()
	{
		$this
			->given(
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(0, new comparison\binary\equal))
		;
	}

	function testRecipientOfComparisonWithValueIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$firstOperand = uniqid(),
				$secondOperand = uniqid(),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($firstOperand, $comparison)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithValueIs($secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenValuesIs')
						->withArguments($firstOperand, $secondOperand, $recipient)
							->once
		;
	}
}
