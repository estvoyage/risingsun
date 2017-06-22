<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class right extends units\test
{
	use units\providers\datum\operation\padding;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs_withNoMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $length = new mockOfOInteger\unsigned),
				$firstOperand = new mockOfDatum,
				$secondOperand = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumOperationOnDataIs_withEmptyNStrings()
	{
		$this
			->given(
				$firstOperand = new mockOfDatum,
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('');
				},

				$secondOperand = new mockOfDatum,
				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('');
				},

				$length = new mockOfOInteger\unsigned,
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(rand(1, PHP_INT_MAX));
				},

				$this->newTestedInstance($template = new mockOfDatum, $length),

				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	/**
	 * @dataProvider nstringProvider
	 */
	function testRecipientOfDatumOperationOnDataIs_withStrings($firstOperandValue, $secondOperandValue, $lengthValue, $paddedValue)
	{
		$this
			->given(
				$firstOperand = new mockOfDatum,
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) use ($firstOperandValue) {
					$recipient->nstringIs($firstOperandValue);
				},

				$secondOperand = new mockOfDatum,
				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) use ($secondOperandValue) {
					$recipient->nstringIs($secondOperandValue);
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

				$this->newTestedInstance($template, $length),

				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $length))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->once
		;
	}
}
