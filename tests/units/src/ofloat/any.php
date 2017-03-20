<?php namespace estvoyage\risingsun\tests\units\ofloat;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger };
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ofloat as mockOfOFloat, datum as mockOfDatum, ointeger as mockOfOInteger, nstring as mockOfNString };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat')
			->implements('estvoyage\risingsun\datum')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	function testRecipientOfOIntegerWithNFloatIs()
	{
		$this
			->given(
				$value = (float) rand(- PHP_INT_MAX, PHP_INT_MAX),
				$recipient = new mockOfOFloat\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOFloatWithNFloatIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments($this->newTestedInstance($value))
							->once

			->if(
				$childOfTestedClass = new childOfTestedClass
			)
			->then
				->object($childOfTestedClass->recipientOfOFloatWithNFloatIs($value, $recipient))
					->isEqualTo($childOfTestedClass)
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments(new childOfTestedClass($value))
							->once
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('typeError')
				->hasMessage('Value should be a float')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNFloatIs($value)
	{
		$this
			->given(
				$recipient = new mockOfNFloat\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfNFloatIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('nfloatIs')
						->withIdenticalArguments((float) $value)
							->once
		;
	}

	/**
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumWithNStringIs_withValidNString($nstring)
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
					->isEqualTo(new childOfTestedClass)
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new childOfTestedClass($nstring))
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

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNStringIs($value)
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfNStringIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments((string) $value)
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			0.,
			rand(1, PHP_INT_MAX),
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			M_PI,
			- M_PI,
			(string) - M_PI
			- 1e9,
			1e9,
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			'1e9',
		];
	}

	protected function invalidValueProvider()
	{
		return [
			null,
			true,
			false,
			'foobar',
			new \stdclass
		];
	}

	protected function validNStringProvider()
	{
		return [
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) - rand(1, PHP_INT_MAX),
			(string) M_PI,
			(string) - M_PI,
			'1e9',
			'-1e9'
		];
	}

	protected function invalidNStringProvider()
	{
		return [
			'foo',
			'- ' . M_PI,
			'12345foo',
			'foo12345'
		];
	}
}