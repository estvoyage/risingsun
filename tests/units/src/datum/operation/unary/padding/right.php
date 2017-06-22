<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum\operation, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, datum as mockOfDatum };

class right extends units\test
{
	use units\providers\datum\operation\padding;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationWithDatumIs_withNoMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $length = new mockOfOInteger\unsigned, $padding = new mockOfDatum),
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumOperationWithDatumIs_withEmptyNStrings()
	{
		$this
			->given(
				$padding = new mockOfDatum,
				$this->calling($padding)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('');
				},

				$datum = new mockOfDatum,
				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('');
				},

				$length = new mockOfOInteger\unsigned,
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(rand(1, PHP_INT_MAX));
				},

				$this->newTestedInstance($template = new mockOfDatum, $length, $padding),

				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	/**
	 * @dataProvider nstringProvider
	 */
	function testRecipientOfDatumOperationWithDatumIs_withStrings($datumValue, $paddingValue, $lengthValue, $paddedValue)
	{
		$this
			->given(
				$padding = new mockOfDatum,
				$this->calling($padding)->recipientOfNStringIs = function($recipient) use ($paddingValue) {
					$recipient->nstringIs($paddingValue);
				},

				$datum = new mockOfDatum,
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				},

				$length = new mockOfOInteger\unsigned,
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) use ($lengthValue) {
					$recipient->nintegerIs($lengthValue);
				},

				$padded = new mockOfDatum,

				$template = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($paddedValue, $padded) {
					(new comparison\unary\equal($paddedValue))
						->recipientOfComparisonWithOperandIs(
							$nstring,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				},

				$this->newTestedInstance($template, $length, $padding),

				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->once
		;
	}
}
