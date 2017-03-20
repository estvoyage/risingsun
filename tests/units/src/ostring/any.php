<?php namespace estvoyage\risingsun\tests\units\ostring;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger };
use mock\estvoyage\risingsun\{ nstring as mockOfNString, datum as mockOfDatum, ointeger as mockOfOInteger };

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
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumWithNStringIs($nstring, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments($this->newTestedInstance($nstring))
							->once

			->if(
				$testedInstance = new childOfTestedClass
			)
			->then
				->object($testedInstance->recipientOfDatumWithNStringIs($nstring, $recipient))
					->isEqualTo($testedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new childOfTestedClass($nstring))
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
				$recipient = new mockOfOInteger\unsigned\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('unsignedOIntegerIs')
						->withArguments(new ointeger\unsigned\any(strlen($value)))
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
