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

	function testOperandForComparisonIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$reference = uniqid(),
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance($reference, $comparison)
			)
			->then
				->object($this->testedInstance->operandForComparisonIs($value))
					->isEqualTo($this->newTestedInstance($reference, $comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->withArguments($value, $reference)
							->once
		;
	}
}
