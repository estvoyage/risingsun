<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function testRecipientOfOIntegerComparisonWithOIntegerIs()
	{
		$this
			->given(
				$reference = new mockOfOInteger,
				$comparison = new mockOfOInteger\comparison\binary,
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
						->withArguments($ointeger, $reference, $recipient)
							->once
		;
	}
}
