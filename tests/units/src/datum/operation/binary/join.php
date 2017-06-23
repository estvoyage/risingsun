<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class join extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs_withDatumWithNotMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $glue = new mockOfDatum),
				$firstOperand = new mockOfDatum,
				$secondOperand = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $glue))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) {
					$recipient->datumIs(new mockOfDatum);
				},

				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(uniqid());
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $glue))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($glue)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(uniqid());
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $glue))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNStringIs->doesNothing,

				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(uniqid());
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $glue))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumOperationOnDataIs_withDatumWithNString()
	{
		$this
			->given(
				$join = new mockOfDatum,

				$template = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($join) {
					(new comparison\unary\equal('foo:bar'))
						->recipientOfComparisonWithOperandIs(
							$nstring,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $join)
								{
									$recipient->datumIs($join);
								}
							)
						)
					;
				},

				$firstOperand = new mockOfDatum,
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},

				$secondOperand = new mockOfDatum,
				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},

				$glue = new mockOfDatum,
				$this->calling($glue)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(':');
				},

				$recipient = new mockOfDatum\recipient,

				$this->newTestedInstance($template, $glue)
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $glue))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($join)
							->once
		;
	}
}
