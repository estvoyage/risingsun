<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum),
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},

				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},

				$operation = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($operation) {
					(new comparison\unary\equal('foobar'))
						->recipientOfComparisonWithOperandIs(
							$value,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $operation)
								{
									$recipient->datumis($operation);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($operation)
							->once
		;
	}
}
