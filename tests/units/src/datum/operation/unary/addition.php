<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class addition extends units\test
{
	use units\providers\datum\operation\addition;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationWithDatumIs_withDatumWithNoMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $suffix = new mockOfDatum),
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $suffix))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	/**
	 * @dataProvider nStringProvider
	 */
	function testRecipientOfDatumOperationWithDatumIs_withDatumWithMessage($firstDatumValue, $secondDatumValue, $additionValue)
	{
		$this
			->given(
				$addition = new mockOfDatum,

				$template = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($addition, $additionValue) {
					(new comparison\unary\equal($additionValue))
						->recipientOfComparisonWithOperandIs(
							$value,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $addition)
								{
									$recipient->datumIs($addition);
								}
							)
						)
					;
				},

				$suffix = new mockOfDatum,
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) use ($secondDatumValue) {
					$recipient->nstringIs($secondDatumValue);
				},

				$this->newTestedInstance($template, $suffix),

				$datum = new mockOfDatum,
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($firstDatumValue) {
					$recipient->nstringIs($firstDatumValue);
				},

				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $suffix))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($addition)
							->once
		;
	}
}
