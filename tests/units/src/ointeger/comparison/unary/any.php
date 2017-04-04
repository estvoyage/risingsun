<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$comparison = new mockOfOInteger\comparison\binary
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($comparison, new ointeger\any))
		;
	}

	function testOIntegerForComparisonIs()
	{
		$this
			->given(
				$comparison = new mockOfOInteger\comparison\binary,
				$reference = new mockOfOInteger,
				$ointeger = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($comparison, $reference)
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($comparison, $reference))
				->mock($comparison)
					->receive('referenceForComparisonWithOIntegerIs')
						->withArguments($ointeger, $reference)
							->once
		;
	}
}
