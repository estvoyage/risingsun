<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat };
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, oboolean as mockOfOBoolean };

class any extends units\test
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
				$comparison = new mockOfOFloat\comparison\binary
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($comparison, new ofloat\any))
		;
	}

	function testRecipientOfOFloatComarisonWithOFloatIs()
	{
		$this
			->given(
				$comparison = new mockOfOFloat\comparison\binary,
				$reference = new mockOfOFloat,
				$ofloat = new mockOfOFloat,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($comparison, $reference)
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($comparison, $reference))
				->mock($comparison)
					->receive('recipientOfOFloatComparisonBetweenOFloatsIs')
						->withArguments($ofloat, $reference, $recipient)
							->once
		;
	}
}
