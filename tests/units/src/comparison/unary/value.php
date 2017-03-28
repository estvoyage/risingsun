<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, oboolean as mockOfOBoolean };

class value extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(0, new comparison\binary\equal))
		;
	}

	function testRecipientOfComparisonWithValueIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$reference = uniqid(),
				$value = uniqid(),
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($reference, $comparison)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $comparison))
				->mock($comparison)
					->receive('recipientOfComparisonBetweenValuesIs')
						->withArguments($value, $reference, $recipient)
							->once
		;
	}
}
