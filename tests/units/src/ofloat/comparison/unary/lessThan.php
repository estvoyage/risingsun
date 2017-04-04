<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat, block };
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, block as mockOfBlock };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\unary')
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
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new ofloat\any, new block\blackhole))
		;
	}

	function testOFloatForComparisonIs()
	{
		$this
			->given(
				$reference = new mockOfOFloat,
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$ofloat = new mockOfOFloat
			)
			->if(
				$this->newTestedInstance($ok, $reference, $ko)
			)
			->then
				->object($this->testedInstance->oFloatForComparisonIs($ofloat))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
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
				$referenceValue = 1.2
			)
			->then
				->object($this->testedInstance->oFloatForComparisonIs($ofloat))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
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
				$ofloatValue = 2.3
			)
			->then
				->object($this->testedInstance->oFloatForComparisonIs($ofloat))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
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
				->object($this->testedInstance->oFloatForComparisonIs($ofloat))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$ofloatValue = - $referenceValue
			)
			->then
				->object($this->testedInstance->oFloatForComparisonIs($ofloat))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice
		;
	}
}
