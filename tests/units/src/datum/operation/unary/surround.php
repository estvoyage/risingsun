<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class surround extends units\test
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
				$this->newTestedInstance($template = new mockOfDatum, $leftSurrounder = new mockOfDatum, $rightSurrounder = new mockOfDatum),

				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $leftSurrounder, $rightSurrounder))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$surround = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($surround) {
					(new comparison\unary\equal('(foo)'))
						->recipientOfComparisonWithOperandIs(
							$nstring,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $surround)
								{
									$recipient->datumIs($surround);
								}
							)
						)
					;
				},

				$this->calling($leftSurrounder)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('(');
				},

				$this->calling($rightSurrounder)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(')');
				},

				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $leftSurrounder, $rightSurrounder))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($surround)
							->once
		;
	}
}
