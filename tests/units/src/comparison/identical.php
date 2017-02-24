<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class identical extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison')
		;
	}

	function testRecipientOfComparisonIs()
	{
		$this
			->given(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = (string) $firstOperand,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once

			->given(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = $firstOperand,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once
		;
	}
}
