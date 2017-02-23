<?php namespace estvoyage\risingsun\tests\units\datum\length\comparison;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean };

class between extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\length\comparison')
		;
	}

	function testDatumLengthIs()
	{
		$this
			->given(
				$length = new mockOfOInteger\unsigned,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($ointeger)
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$this->calling($ointeger)->recipientOfOIntegerComparisonIs = function($aComparison, $aRecipient) use ($length) {
					oboolean\factory::areEquals($aComparison, new ointeger\comparison\unary\greaterThanOrEqualTo)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->obooleanIs(new oboolean\ok);
								}
							)
						)
						->blockForFalseIs(
							new functor(
								function() use ($aComparison, $aRecipient, $length)
								{
									oboolean\factory::areEquals($aComparison, new ointeger\comparison\unary\lessThanOrEqualTo($length))
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
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once

			->if(
				$this->calling($ointeger)->recipientOfOIntegerComparisonIs = function($aComparison, $aRecipient) use ($length) {
					oboolean\factory::areEquals($aComparison, new ointeger\comparison\unary\greaterThanOrEqualTo)
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
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once

			->if(
				$this->calling($ointeger)->recipientOfOIntegerComparisonIs = function($aComparison, $aRecipient) use ($length) {
					oboolean\factory::areEquals($aComparison, new ointeger\comparison\unary\greaterThanOrEqualTo)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->obooleanIs(new oboolean\ok);
								}
							)
						)
						->blockForFalseIs(
							new functor(
								function() use ($aComparison, $aRecipient, $length)
								{
									oboolean\factory::areEquals($aComparison, new ointeger\comparison\unary\lessThanOrEqualTo($length))
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
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->twice
		;
	}
}
