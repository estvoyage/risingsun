<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ofloat as mockOfOFloat };

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
		$this
			->given(
				$ok = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole));
	}

	function testReferenceForComparisonWithOFloatIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$ofloat = new mockOfOFloat,
				$reference = new mockOfOFloat
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
				$this->calling($ofloat)->recipientOfNFloatIs = function($recipient) use (& $ofloatValue) {
					$recipient->nfloatIs($ofloatValue);
				}
			)
			->if(
				$ofloatValue = 1.2
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
				$referenceValue = 0.3
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$ofloatValue = $referenceValue
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$referenceValue = 2.5
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOFloatIs($ofloat, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice
		;
	}
}
