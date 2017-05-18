<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class any extends units\test
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
				$this->newTestedInstance($reference = uniqid(), $comparison = new mockOfComparison\binary),
				$operand = uniqid(),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($reference, $comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenOperandAndReferenceIs')
						->withArguments($operand, $reference, $recipient)
							->once
		;
	}
}
