<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class copy extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum),
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},
				$copy = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($copy) {
					(new comparison\unary\equal('foo'))
						->recipientOfComparisonWithOperandIs(
							$nstring,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $copy)
								{
									$recipient->datumIs($copy);
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
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($copy)
							->once
		;
	}
}
