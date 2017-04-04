<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function testReferenceForComparisonWithOFloatIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$ofloat = new mockOfOFloat,
				$reference = new mockOfOFloat
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->never

			->given(
				$ofloatValue = 1.2
			)
			->if(
				$this->calling($ofloat)->recipientOfNFloatIs = function($recipient) use ($ofloatValue) {
					$recipient->nfloatIs($ofloatValue);
				}
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->never

			->given(
				$referenceValue = 8.5
			)
			->if(
				$this->calling($reference)->recipientOfNFloatIs = function($recipient) use ($referenceValue) {
					$recipient->nfloatIs($referenceValue);
				}
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->withArguments($ofloatValue, $referenceValue)
							->once
		;
	}
}
