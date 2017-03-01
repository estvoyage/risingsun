<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class greaterThanOrEqualTo extends units\test
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
				$firstOperand = 0,
				$secondOperand = 1
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
				$firstOperand = 0,
				$secondOperand = 0
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('comparisonIsTrue')
						->once
					->receive('comparisonIsFalse')
						->once

			->if(
				$firstOperand = 1,
				$secondOperand = 0
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('comparisonIsTrue')
						->twice
					->receive('comparisonIsFalse')
						->once
		;
	}
}
