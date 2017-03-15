<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
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
				$operation = new mockOfNString\operation\binary,
				$firstOperand = new mockOfDatum,
				$secondOperand = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$firstOperandValue = 'foo'
			)
			->if(
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) use ($firstOperandValue) {
					$recipient->nstringIs($firstOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$secondOperandValue = 'bar'
			)
			->if(
				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) use ($secondOperandValue) {
					$recipient->nstringIs($secondOperandValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$operationValue = 'foobar'
			)
			->if(
				$this->calling($operation)->recipientOfOperationOnNStringsIs = function($firstOperand, $secondOperand, $recipient) use ($firstOperandValue, $secondOperandValue, $operationValue) {
					if ($firstOperandValue == $firstOperand && $secondOperandValue = $secondOperand)
					{
						$recipient->nstringIs($operationValue);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$datum = new mockOfDatum
			)
			->if(
				$this->calling($firstOperand)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($operationValue, $datum) {
					if ($nstring == $operationValue)
					{
						$recipient->datumIs($datum);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($datum)
							->once
		;
	}
}
