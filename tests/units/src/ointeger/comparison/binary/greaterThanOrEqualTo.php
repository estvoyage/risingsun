<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean };

class greaterThanOrEqualTo extends units\test
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
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->if(
				$firstOperandValue = 0
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->if(
				$secondOperandValue = 1
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once

			->if(
				$firstOperandValue = 1,
				$secondOperandValue = 0
			)
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once

			->if(
				$firstOperandValue = 1,
				$secondOperandValue = 1
			)
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->twice
		;
	}
}
