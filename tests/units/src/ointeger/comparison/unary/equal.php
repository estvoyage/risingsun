<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock, oboolean as mockOfOBoolean };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function testConstructor()
	{
		$this
			->given(
				$reference = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($reference)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($reference, new ointeger\comparison\binary\equal))
		;
	}

	function testRecipientOfOIntegerComparisonWithOIntegerIs()
	{
		$this
			->given(
				$reference = new mockOfOInteger,
				$comparison = new mockOfOInteger\comparison\binary\equal,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($reference, $comparison)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $comparison))
				->mock($comparison)
					->receive('recipientOfOIntegerComparisonBetweenOIntegersIs')
						->withIdenticalArguments($reference, $ointeger, $recipient)
							->once
		;
	}
}
