<?php namespace estvoyage\risingsun\tests\units\ostring;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nstring as mockOfNString, datum as mockOfDatum };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
			->implements('estvoyage\risingsun\ostring')
		;
	}

	function testWithNoValue()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(''));
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValidValue($value)
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($value)
					->recipientOfNStringIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('nstringIs')
						->withArguments((string) $value)
							->once
		;
	}

	/**
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumWithValueIs($nstring)
	{
		$this
			->given(
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumWithValueIs($nstring, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments($this->newTestedInstance($nstring))
							->once

			->if(
				$testedInstance = new childOfTestedClass
			)
			->then
				->object($testedInstance->recipientOfDatumWithValueIs($nstring, $recipient))
					->isEqualTo($testedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new childOfTestedClass($nstring))
							->once
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
						->withArguments(
							$this->testedInstance,
							$datum,
							$recipient
						)
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			-PHP_INT_MAX,
			PHP_INT_MAX,
			'0',
			(string) - PHP_INT_MAX,
			(string) PHP_INT_MAX,
			'',
			uniqid(),
			null
		];
	}

	protected function validNStringProvider()
	{
		return [
			'0',
			(string) - PHP_INT_MAX,
			(string) PHP_INT_MAX,
			'',
			uniqid()
		];
	}
}
