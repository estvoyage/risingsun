<?php namespace estvoyage\risingsun\tests\units\datum\finder;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, ointeger };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class after extends units\test
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
				$offset = new mockOfOInteger\unsigned
			)
			->if(
				$this->newTestedInstance($finder, $offset)
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $offset))
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
					oboolean\factory::areIdenticals($aSearch, $search)
						->blockForTrueIs(
							new functor(
								function() use ($aDatum, $datum, $aRecipient, $position)
								{
									oboolean\factory::areIdenticals($aDatum, $datum)
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
					->isEqualTo($this->newTestedInstance($finder, $offset))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never
					->receive('datumDoesNotExist')
						->never

			->given(
				$positionWithOffset = new mockOfOInteger\unsigned
			)
			->if(
				$this->calling($position)->recipientOfOIntegerOperationIs = function($anOperation, $aRecipient) use ($positionWithOffset, $offset) {
					oboolean\factory::areEquals($anOperation, new ointeger\operation\unary\addition($offset))
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient, $positionWithOffset)
								{
									$aRecipient->ointegerIs($positionWithOffset);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $offset))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withIdenticalArguments($positionWithOffset)
							->once
					->receive('datumDoesNotExist')
						->never

			->if(
				$this->calling($finder)->recipientOfSearchOfDatumInDatumIs = function($aSearch, $aDatum, $aRecipient) {
					$aRecipient->datumDoesNotExist();
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($finder, $offset))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withIdenticalArguments($positionWithOffset)
							->once
					->receive('datumDoesNotExist')
						->once
		;
	}
}
