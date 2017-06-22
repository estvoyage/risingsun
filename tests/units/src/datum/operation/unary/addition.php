<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationWithDatumIs()
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

			->given(
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},

				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},

				$addition = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($addition) {
					(new comparison\unary\equal('foobar'))
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
				}
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
