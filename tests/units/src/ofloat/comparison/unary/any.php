<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat };
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\unary')
		;
	}

	function testRecipientOfComparisonWithOFloatIs()
	{
		$this
			->given(
				$comparison = new mockOfOFloat\comparison\binary,
				$reference = new mockOfOFloat,
				$ofloat = new mockOfOFloat,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($comparison, $reference)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($comparison, $reference))
				->mock($comparison)
					->receive('recipientOfOfloatComparisonBetweenOperandAndReferenceIs')
						->withArguments($ofloat, $reference, $recipient)
							->once
		;
	}
}
