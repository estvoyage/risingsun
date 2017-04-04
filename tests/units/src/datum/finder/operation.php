<?php namespace estvoyage\risingsun\tests\units\datum\finder;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block, datum };
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
				$search = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\finder\recipient
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

			->given(
				$position = new datum\length
			)
			->if(
				$this->calling($finder)->recipientOfSearchOfDatumInDatumIs = function($aSearch, $aDatum, $aRecipient) use ($search, $datum, $position) {
					oboolean\factory::areEquals($search, $aSearch)
						->blockForTrueIs(
							new block\functor(
								function() use ($aDatum, $aRecipient, $datum, $position)
								{
									oboolean\factory::areEquals($datum, $aDatum)
										->blockForTrueIs(
											new block\functor(
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

			->given(
				$positionAfterOperation = new datum\length(1)
			)
			->if(
				$this->calling($operation)->recipientOfOperationWithOIntegerIs = function($anOInteger, $aRecipient) use ($position, $positionAfterOperation) {
					oboolean\factory::areIdenticals($anOInteger, $position)
						->blockForTrueIs(
							new block\functor(
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

			->given(
				$datumLength = new datum\length(2)
			)
			->if(
				$this->calling($datum)->recipientOfDatumLengthIs = function($recipient) use ($datumLength) {
					$recipient->datumLengthIs($datumLength);
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $operation))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withArguments($positionAfterOperation)
							->once
		;
	}
}
