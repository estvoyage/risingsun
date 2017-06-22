<?php namespace estvoyage\risingsun\tests\units\time\duration\formater;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, datum };
use mock\estvoyage\risingsun\{ output as mockOfOutput, time as mockOfTime, datum as mockOfDatum };

class seconde extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\formater')
		;
	}

	function testOutputForDurationIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$duration = new mockOfTime\duration,
				$operation = new mockOfDatum\operation\unary,
				$this->newTestedInstance($operation)
			)
			->if(
				$this->testedInstance->outputForDurationIs($duration, $output)
			)
			->then
				->mock($output)
					->receive('datumIs')
						->never

			->given(
				$seconde = new mockOfTime\duration\seconde,
				$this->calling($duration)->recipientOfNumberOfSecondeIs = function($recipient) use ($seconde) {
					$recipient->secondeIs($seconde);
				},
				$secondeAfterOperation = new mockOfDatum,
				$this->calling($operation)->recipientOfDatumOperationWithDatumIs = function($datum, $recipient) use ($seconde, $secondeAfterOperation) {
					(new datum\comparison\binary\identical)
						->recipientOfDatumComparisonBetweenOperandAndReferenceIs(
							$datum,
							$seconde,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $secondeAfterOperation)
								{
									$recipient->datumIs($secondeAfterOperation);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->outputForDurationIs($duration, $output)
			)
			->then
				->mock($output)
					->receive('datumIs')
						->withArguments($secondeAfterOperation)
							->once
		;
	}
}
