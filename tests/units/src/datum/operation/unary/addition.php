<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
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
				$this->calling($datum)->recipientOfDatumWithValueIs = function($value, $recipient) use ($addition) {
					oboolean\factory::areEquals($value, 'foobar')
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $addition)
								{
									$recipient->datumIs($addition);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($addition)
							->once
		;
	}
}
