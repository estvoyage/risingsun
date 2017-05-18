<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class blank extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function testRecipientOfComparisonWithOperandIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$operand = '',
				$recipient = new mockOfComparison\recipient
			)

			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once

			->given(
				$operand = null
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->twice

			->given(
				$operand = uniqid()
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}
}
