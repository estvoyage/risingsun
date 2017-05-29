<?php namespace estvoyage\risingsun\tests\units\datum\finder;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class operation extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\finder')
		;
	}

	function testRecipientOfSearchOfDatumInDatumIs()
	{
		$this
			->given(
				$finder = new mockOfDatum\finder,
				$operation = new mockOfOInteger\operation\unary,
				$this->newTestedInstance($finder, $operation),
				$search = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\finder\recipient
			)
			->if(
				$this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never

			->given(
				$position = new mockOfOInteger,
				$this->calling($finder)->recipientOfSearchOfDatumInDatumIs = function($aSearch, $aDatum, $aRecipient) use ($search, $datum, $position) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$search,
							$aSearch,
							new comparison\recipient\functor\ok(
								function() use ($aDatum, $aRecipient, $datum, $position)
								{
									(new comparison\binary\equal)
										->recipientOfComparisonBetweenOperandAndReferenceIs(
											$datum,
											$aDatum,
											new comparison\recipient\functor\ok(
												function() use ($aRecipient, $position)
												{
													$aRecipient->datumIsAtPosition($position);
												}
											)
										)
									;
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never

			->given(
				$positionAfterOperation = new mockOfOInteger,
				$this->calling($operation)->recipientOfOperationWithOIntegerIs = function($anOInteger, $aRecipient) use ($position, $positionAfterOperation) {
					(new comparison\binary\identical)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOInteger,
							$position,
							new comparison\recipient\functor\ok(
								function() use ($aRecipient, $positionAfterOperation)
								{
									$aRecipient->ointegerIs($positionAfterOperation);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never

//			->given(
//				$datumLength = new datum\length(2)
//			)
//			->if(
//				$this->calling($datum)->recipientOfDatumLengthIs = function($recipient) use ($datumLength) {
//					$recipient->datumLengthIs($datumLength);
//				}
//			)
//			->then
//				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
//					->isEqualTo($this->newTestedInstance($finder, $operation))
//				->mock($recipient)
//					->receive('datumIsAtPosition')
//						->withArguments($positionAfterOperation)
//							->once
		;
	}
}
