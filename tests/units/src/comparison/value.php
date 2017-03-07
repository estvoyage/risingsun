<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, oboolean as mockOfOBoolean };

class value extends units\test
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
				$firstOperand = uniqid(),
				$comparison = new mockOfComparison\unary,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($firstOperand, $comparison)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($firstOperand, $comparison))
				->mock($comparison)
					->receive('recipientOfComparisonWithValueIs')
						->withArguments($firstOperand, $recipient)
							->once
		;
	}
}
