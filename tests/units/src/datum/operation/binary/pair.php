<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ostring, comparison };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class pair extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$template = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($template)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, new ostring\any('('), new ostring\any(':'), new ostring\any(')')));
	}

	function testRecipientOfDatumOperationOnDataIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $prefix = new mockOfDatum, $separator = new mockOfDatum, $suffix = new mockOfDatum),
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $prefix, $separator, $suffix))
				->mock($recipient)
					->receive('datumIs')
						->never

			->if(
				$this->calling($prefix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('(');
				},
				$this->calling($separator)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(':');
				},
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(')');
				},
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},
				$operation = new mockOfDatum,
				$this->calling($template)->recipientOfDatumFromDatumIs = function($datum, $recipient) use ($operation) {
					(new comparison\unary\equal(new ostring\any('(foo:bar)')))
						->recipientOfComparisonWithOperandIs(
							$datum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $operation)
								{
									$recipient->datumIs($operation);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance($template, $prefix, $separator, $suffix))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($operation)
							->once
		;
	}
}
