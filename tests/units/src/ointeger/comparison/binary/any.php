<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function testReferenceForComparisonWithOIntegerIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\binary,
				$ointeger = new mockOfOInteger,
				$reference = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOIntegerIs($ointeger, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->never

			->given(
				$ointegerValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->if(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use ($ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOIntegerIs($ointeger, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->never

			->given(
				$referenceValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->if(
				$this->calling($reference)->recipientOfNIntegerIs = function($recipient) use ($referenceValue) {
					$recipient->nintegerIs($referenceValue);
				}
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOIntegerIs($ointeger, $reference))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($comparison)
					->receive('referenceForComparisonWithOperandIs')
						->withArguments($ointegerValue, $referenceValue)
							->once
		;
	}
}
