<?php namespace estvoyage\risingsun\tests\units\ostring;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, datum };
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
	function testRecipientOfDatumWithNStringIs($nstring)
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumWithNStringIs($nstring, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments($this->newTestedInstance($nstring))
							->once

			->given(
				$testedInstance = $this->childOfTestedClass()
			)
			->if(
				$testedInstance->recipientOfDatumWithNStringIs($nstring, $recipient)
			)
			->then
				->object($testedInstance)
					->isEqualTo($testedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments($this->childOfTestedClass($nstring))
							->once
		;
	}

	/**
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumLengthIs($value)
	{
		$this
			->given(
				$this->newTestedInstance($value),
				$recipient = new mockOfDatum\length\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumLengthIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('datumLengthIs')
						->withArguments(new datum\length(strlen($value)))
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			PHP_INT_MIN,
			PHP_INT_MAX,
			'0',
			(string) PHP_INT_MIN,
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
			(string) PHP_INT_MIN,
			(string) PHP_INT_MAX,
			'',
			uniqid()
		];
	}
}
