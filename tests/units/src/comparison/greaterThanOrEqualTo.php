<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class greaterThanOrEqualTo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison')
		;
	}

	function testConstructor()
	{
		$this
			->given(
				$firstOperand = 0,
				$secondOperand = 1
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, new oboolean\ok))

			->if(
				$this->newTestedInstance($firstOperand)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($firstOperand, 0, new oboolean\ok))
		;
	}

	function testRecipientOfComparisonIs()
	{
		$this
			->given(
				$oboolean = new mockOfOBoolean,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$firstOperand = 0,
				$secondOperand = 1,
				$this->newTestedInstance($firstOperand, $secondOperand, $oboolean)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$firstOperand = 0,
				$secondOperand = 0,
				$this->newTestedInstance($firstOperand, $secondOperand, $oboolean)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($oboolean)
							->once

			->if(
				$firstOperand = 1,
				$secondOperand = 0,
				$this->newTestedInstance($firstOperand, $secondOperand, $oboolean)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($oboolean)
							->twice
		;
	}
}
