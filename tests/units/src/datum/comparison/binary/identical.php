<?php namespace estvoyage\risingsun\tests\units\datum\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, comparison as mockOfComparison };

class identical extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\comparison\binary')
		;
	}

	function testRecipientOfDatumComparisonBetweenOperandAndReferenceIs()
	{
		$this
			->given(
				$operand = new mockOfDatum,
				$reference = new mockOfDatum,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfDatumComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}
}
