<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class addition extends units\test
{
	use units\providers\datum\operation\addition;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs_withDatumWithNoMessage()
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
		;
	}

	/**
	 * @dataProvider nStringProvider
	 */
	function testRecipientOfDatumOperationOnDataIs_withDatumWithMessages($firstDatumValue, $secondDatumValue, $operationValue)
	{
		$this
			->given(
				$operation = new mockOfDatum,

				$template = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($operation, $operationValue) {
					(new comparison\unary\equal($operationValue))
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
				},

				$firstDatum = new mockOfDatum,
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) use ($firstDatumValue) {
					$recipient->nstringIs($firstDatumValue);
				},

				$secondDatum = new mockOfDatum,
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) use ($secondDatumValue) {
					$recipient->nstringIs($secondDatumValue);
				},

				$recipient = new mockOfDatum\recipient,

				$this->newTestedInstance($template)
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
