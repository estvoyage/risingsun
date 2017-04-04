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
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$firstDatumValue = 'foo'
			)
			->if(
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) use ($firstDatumValue) {
					$recipient->nstringIs($firstDatumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$secondDatumValue = 'bar'
			)
			->if(
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) use ($secondDatumValue) {
					$recipient->nstringIs($secondDatumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$operation = new mockOfDatum
			)
			->if(
				$this->calling($firstDatum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($operation) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($recipient, $operation)
								{
									$recipient->datumis($operation);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($value, 'foobar')
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($operation)
							->once
		;
	}
}
