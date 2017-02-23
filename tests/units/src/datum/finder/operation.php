<?php namespace estvoyage\risingsun\tests\units\datum\finder;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, datum };
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
				$search = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\finder\recipient,
				$finder = new mockOfDatum\finder,
				$operation = new mockOfOInteger\operation\unary
			)
			->if(
				$this->newTestedInstance($finder, $operation)
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never
					->receive('datumDoesNotExist')
						->never

			->given(
				$position = new mockOfOInteger\unsigned
			)
			->if(
				$this->calling($finder)->recipientOfSearchOfDatumInDatumIs = function($aSearch, $aDatum, $aRecipient) use ($search, $datum, $position) {
					oboolean\factory::areEquals($search, $aSearch)
						->blockForTrueIs(
							new functor(
								function() use ($aDatum, $aRecipient, $datum, $position)
								{
									oboolean\factory::areEquals($datum, $aDatum)
										->blockForTrueIs(
											new functor(
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
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never
					->receive('datumDoesNotExist')
						->never

			->given(
				$positionAfterOperation = new mockOfOInteger\unsigned
			)
			->if(
				$this->calling($operation)->recipientOfOperationWithOIntegerIs = function($anOInteger, $aRecipient) use ($position, $positionAfterOperation) {
					oboolean\factory::areIdenticals($anOInteger, $position)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient, $positionAfterOperation)
								{
									$aRecipient->ointegerIs($positionAfterOperation);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never
					->receive('datumDoesNotExist')
						->never

			->if(
				$this->calling($datum)->recipientOfDatumLengthComparisonIs = function($aComparison, $aRecipient) use ($positionAfterOperation) {
					oboolean\factory::areEquals($aComparison, new datum\length\comparison\between($positionAfterOperation))
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->obooleanIs(new oboolean\ok);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withIdenticalArguments($positionAfterOperation)
							->once
					->receive('datumDoesNotExist')
						->never

			->if(
				$this->calling($datum)->recipientOfDatumLengthComparisonIs = function($aComparison, $aRecipient) use ($positionAfterOperation) {
					oboolean\factory::areEquals($aComparison, new datum\length\comparison\between($positionAfterOperation))
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->obooleanIs(new oboolean\ko);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withIdenticalArguments($positionAfterOperation)
							->once
					->receive('datumDoesNotExist')
						->never
		;
	}
}
