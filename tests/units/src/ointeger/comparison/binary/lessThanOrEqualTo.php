<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean };

class lessThanOrEqualTo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function testConstructor()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok));
	}

	function testRecipientOfOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient,
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->newTestedInstance($oboolean)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				}
			)
			->if(
				$firstOperandValue = 1
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				}
			)
			->if(
				$secondOperandValue = 0
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = 1
			)
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($oboolean)
							->once

			->if(
				$firstOperandValue = 0,
				$secondOperandValue = 0
			)
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($oboolean)
							->twice
		;
	}
}
