<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, iterator as mockOfIterator };

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
				$container = new mockOfComparison\container,
				$iterator = new mockOfComparison\container\iterator,
				$recipient = new mockOfComparison\recipient,
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
					->receive('controllerOfPayloadForComparisonContainerIteratorIs')
						->withArguments(
								new comparison\binary\conjunction\payload(
									$firstOperand,
									$secondOperand
								),
								$iterator,
								new comparison\binary\conjunction\controller(
									$recipient
								)
							)
							->once
		;
	}
}
