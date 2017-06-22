<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class any extends units\test
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
				$this->newTestedInstance($template = new mockOfDatum, $operation = new mockOfNString\operation\binary),
				$firstOperand = new mockOfDatum,
				$secondOperand = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $operation))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},

				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},

				$this->calling($operation)->recipientOfOperationOnNStringsIs = function($firstOperand, $secondOperand, $recipient) {
					(new comparison\unary\equal('foo'))
						->recipientOfComparisonWithOperandIs(
							$firstOperand,
							new comparison\recipient\functor\ok(
								function() use ($secondOperand, $recipient)
								{
									(new comparison\unary\equal('bar'))
										->recipientOfComparisonWithOperandIs(
											$secondOperand,
											new comparison\recipient\functor\ok(
												function() use ($recipient)
												{
													$recipient->nstringIs('foobar');
												}
											)
										)
									;
								}
							)
						)
					;
				},

				$datum = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($datum) {
					(new comparison\unary\equal('foobar'))
						->recipientOfComparisonWithOperandIs(
							$nstring,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datum)
								{
									$recipient->datumIs($datum);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $operation))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($datum)
							->once
		;
	}
}
