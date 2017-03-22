<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok, new oboolean\ko));
	}

	function testRecipientOfOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$firstOperandValue = -1
			)
			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$secondOperandValue = 1
			)
			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once

			->if(
				$secondOperandValue = $firstOperandValue
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once
		;
	}
}
