<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, ofloat as mockOfOFloat };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok, new oboolean\ko));
	}

	function testRecipientOfOFloatComparisonBetweenOFloatsIs()
	{
		$this
			->given(
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$firstOperand = new mockOfOFloat,
				$secondOperand = new mockOfOFloat,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

		->given(
				$this->calling($firstOperand)->recipientOfNFloatIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nfloatIs($firstOperandValue);
				}
			)
			->if(
				$firstOperandValue = 1.2
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($secondOperand)->recipientOfNFloatIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nfloatIs($secondOperandValue);
				}
			)
			->if(
				$secondOperandValue = 0.3
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once

			->if(
				$secondOperandValue = $firstOperandValue
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->twice

			->if(
				$secondOperandValue = 2.5
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonBetweenOFloatsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once
		;
	}
}
