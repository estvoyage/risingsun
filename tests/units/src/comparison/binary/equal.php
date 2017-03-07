<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok, new oboolean\ko));
	}

	function testRecipientOfComparisonBetweenValuesIs()
	{
		$this
			->given(
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$recipient = new mockOfOBoolean\recipient,
				$this->newTestedInstance($ok, $ko)
			)
			->if(
				$firstOperand = uniqid(),
				$secondOperand = uniqid()
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand,$recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->never
						->withArguments($ko)
							->once

			->if(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = (string) $firstOperand
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once
						->withArguments($ko)
							->once

			->if(
				$firstOperand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$secondOperand = $firstOperand
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->twice
						->withArguments($ko)
							->once
		;
	}
}
