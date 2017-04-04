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
				$suffix = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($suffix)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('datumIs')
						->never

			->if(
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},
				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$addition = new mockOfDatum
			)
			->if(
				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($addition) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($recipient, $addition)
								{
									$recipient->datumIs($addition);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($value, 'foobar')
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($addition)
							->once
		;
	}
}
