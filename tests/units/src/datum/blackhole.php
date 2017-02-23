<?php namespace estvoyage\risingsun\tests\units\datum;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nstring as mockOfNString, datum as mockOfDatum, oboolean as mockOfOBoolean };

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
		;
	}

	function testRecipientOfNStringIs()
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfNStringIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->never
		;
	}

	function testRecipientOfDatumWitValueIs()
	{
		$this
			->given(
				$value = uniqid(),
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumOperationWithDatumIs()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\binary,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($operation, $datum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($operation)
					->receive('recipientOfDatumOperationOnDataIs')
						->never
		;
	}

	function testRecipientOfDatumOperationIs()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\unary,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationIs($operation, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($operation)
					->receive('recipientOfDatumOperationWithDatumIs')
						->never
		;
	}

	function testRecipientOfDatumLengthComparisonIs()
	{
		$this
			->given(
				$comparison = new mockOfDatum\length\comparison,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonIs($comparison, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($comparison)
					->receive('recipientOfDatumLengthComparisonWithDatumLengthIs')
						->never
		;
	}
}
