<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, iterator as mockOfIterator, oboolean as mockOfOBoolean };

class conjunction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
	}

	function testRecipientOfComparisonBetweenValuesIs()
	{
		$this
			->given(
				$container = new mockOfComparison\binary\container,
				$iterator = new mockOfComparison\binary\container\iterator,
				$recipient = new mockOfOBoolean\recipient,
				$this->newTestedInstance($container, $iterator)
			)
			->if(
				$firstOperand = uniqid(),
				$secondOperand = uniqid()
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($container, $iterator))
				->mock($container)
					->receive('payloadForBinaryComparisonContainerIteratorIs')
						->withArguments(
								$iterator,
								new comparison\binary\conjunction\payload(
									$firstOperand,
									$secondOperand,
									$recipient
								)
							)
							->once
		;
	}
}
