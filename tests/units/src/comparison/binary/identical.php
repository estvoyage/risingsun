<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class identical extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
	}

	function testRecipientOfComparisonBetweenValuesIs()
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient,
				$this->newTestedInstance
			)
			->if(
				$firstOperand = uniqid(),
				$secondOperand = uniqid()
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('comparisonIsTrue')
						->never
					->receive('comparisonIsFalse')
						->once

			->if(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = (string) $firstOperand
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('comparisonIsTrue')
						->never
					->receive('comparisonIsFalse')
						->twice

			->if(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = $firstOperand
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('comparisonIsTrue')
						->once
					->receive('comparisonIsFalse')
						->twice
		;
	}
}
