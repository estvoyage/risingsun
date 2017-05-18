<?php namespace estvoyage\risingsun\tests\units\ofloat\unsigned;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum };
use mock\estvoyage\risingsun\{ datum as mockOfDatum };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
			->implements('estvoyage\risingsun\ofloat')
			->implements('estvoyage\risingsun\ofloat\unsigned')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('typeError')
				->hasMessage('Value should be an unsigned float')
		;
	}

	/**
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumWithNStringIs_withValidNString($nstring)
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
					->isEqualTo($this->childOfTestedClass())
				->mock($recipient)
					->receive('datumIs')
						->withArguments($this->childOfTestedClass($nstring))
							->once
		;
	}

	/**
	 * @dataProvider invalidNStringProvider
	 */
	function testRecipientOfDatumWithNStringIs_withInvalidNString($nstring)
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
						->never
		;
	}

	/**
	 * @dataProvider validValueProvider
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
			'0',
			0.,
			'0.',
			rand(1, PHP_INT_MAX),
			(string) rand(1, PHP_INT_MAX),
			M_PI,
			(string) M_PI,
			1e9,
			'1e9',
			0x539,
			02471,
			'02471',
			0b10100111001
		];
	}

	protected function invalidValueProvider()
	{
		return [
			null,
			true,
			false,
			'foobar',
			new \stdclass,
		 	rand(PHP_INT_MIN, -1),
		 	(string) rand(PHP_INT_MIN, -1),
			- M_PI,
			(string) - M_PI,
		];
	}

	protected function validNStringProvider()
	{
		return [
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			'1e9'
		];
	}

	protected function invalidNStringProvider()
	{
		return [
			'foo',
			'- ' . M_PI,
			'12345foo',
			'foo12345',
			(string) - rand(1, PHP_INT_MAX),
			(string) - M_PI,
			'-1e9'
		];
	}
}
