<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, comparison as mockOfComparison };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function testOIntegerForComparisonIs()
	{
		$this
			->given(
				$comparison = new mockOfOInteger\comparison\binary,
				$reference = new mockOfOInteger,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($comparison, $reference)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($comparison, $reference))
				->mock($comparison)
					->receive('recipientOfOIntegerComparisonBetweenOperandAndReferenceIs')
						->withArguments($ointeger, $reference, $recipient)
							->once
		;
	}
}
