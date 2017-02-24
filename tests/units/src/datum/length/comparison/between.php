<?php namespace estvoyage\risingsun\tests\units\datum\length\comparison;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, ointeger, comparison };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean, datum as mockOfDatum };

class between extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\length\comparison')
		;
	}

	function testWithNoValue()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($ointeger)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo(
						$this->newTestedInstance(
							$ointeger,
							new ointeger\comparison\binary\lessThanOrEqualTo,
							new ointeger\comparison\binary\greaterThanOrEqualTo
						)
					)
		;
	}

	function testDatumLengthIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,
				$less = new mockOfOInteger\comparison\binary\lessThanOrEqualTo,
				$greater = new mockOfOInteger\comparison\binary\greaterThanOrEqualTo,
				$length = new mockOfOInteger\unsigned,
				$recipient = new mockOfOBoolean\recipient
			)

			->if(
				$this->newTestedInstance($ointeger, $less, $greater)
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger, $less, $greater))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($greater)->recipientOfOIntegerComparisonBetweenOIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($ointeger, & $isGreater) {
					(
						new comparison\conjunction(
							new comparison\identical($firstOperand, $ointeger),
							new comparison\equal($secondOperand, new ointeger\any)
						)
					)
						->recipientOfComparisonIs(
							new oboolean\recipient\forward($recipient, $isGreater)
						)
					;
				},

				$this->calling($less)->recipientOfOIntegerComparisonBetweenOIntegersIs = function($firstOperand, $secondOperand, $recipient) use ($ointeger, $length, & $isLess) {
					(
						new comparison\conjunction(
							new comparison\identical($firstOperand, $ointeger),
							new comparison\identical($secondOperand, $length)
						)
					)
						->recipientOfComparisonIs(
							new oboolean\recipient\forward($recipient, $isLess)
						)
					;
				}
			)

			->if(
				$isGreater = new oboolean\ko,
				$isLess = new oboolean\ko
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger, $less, $greater))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once

			->if(
				$isGreater = new oboolean\ok,
				$isLess = new oboolean\ko
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger, $less, $greater))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->twice

			->if(
				$isGreater = new oboolean\ko,
				$isLess = new oboolean\ok
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger, $less, $greater))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->thrice

			->if(
				$isGreater = new oboolean\ok,
				$isLess = new oboolean\ok
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonWithDatumLengthIs($length, $recipient))
					->isEqualTo($this->newTestedInstance($ointeger, $less, $greater))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once
		;
	}
}
