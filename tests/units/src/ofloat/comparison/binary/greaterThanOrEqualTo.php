<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat, block };
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, block as mockOfBlock };

class greaterThanOrEqualTo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\binary')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$ok = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole))
		;
	}

	function testReferenceForComparisonWithOFloatIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$reference = new mockOfOFloat,
				$ofloat = new mockOfOFloat
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($reference)->recipientOfNFloatIs = function($recipient) use (& $referenceValue) {
					$recipient->nfloatIs($referenceValue);
				}
			)
			->if(
				$referenceValue = 0
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($ofloat)->recipientOfNFloatIs = function($recipient) use (& $ofloatValue) {
					$recipient->nfloatIs($ofloatValue);
				}
			)
			->if(
				$ofloatValue = 0
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->if(
				$ofloatValue = rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->twice
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->if(
				$ofloatValue = rand(PHP_INT_MIN, -1)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->twice
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
