<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

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
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = (string) $firstOperand,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once
		;
	}
}
