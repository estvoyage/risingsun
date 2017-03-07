<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class greaterThanOrEqualTo extends units\test
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
				$firstOperand = 0,
				$secondOperand = 1
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once
						->withArguments($ok)
							->never

			->if(
				$firstOperand = 0,
				$secondOperand = 0
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
				$firstOperand = 1,
				$secondOperand = 0
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
