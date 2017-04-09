<?php namespace estvoyage\risingsun\tests\units\ointeger;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, datum };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, ointeger as mockOfOInteger, oboolean as mockOfOBoolean, block as mockOfBlock, nstring as mockOfNString, datum as mockOfDatum };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger')
			->implements('estvoyage\risingsun\datum')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValidValue($value)
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($value)
					->recipientOfNIntegerIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments((int) (string) $value)
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
				->hasMessage('Value should be an integer')
		;
	}

	function testRecipientOfOIntegerWithNIntegerIs()
	{
		$this
			->given(
				$value = rand(PHP_INT_MIN, PHP_INT_MAX),
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerWithNIntegerIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($this->newTestedInstance($value))
							->once

			->if(
				$childOfTestedClass = new childOfTestedClass
			)
			->then
				->object($childOfTestedClass->recipientOfOIntegerWithNIntegerIs($value, $recipient))
					->isEqualTo($childOfTestedClass)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new childOfTestedClass($value))
							->once
		;
	}

	function testRecipientOfOIntegerWithOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance(0)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance(0))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use (& $ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->if(
				$ointegerValue = rand(PHP_INT_MIN, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance(0))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($this->newTestedInstance($ointegerValue))
							->once
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
						->withArguments('0')
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
					->isEqualTo($testedInstance)
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
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumLengthIs($value)
	{
		$this
			->given(
				$recipient = new mockOfDatum\length\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('datumLengthIs')
						->withArguments(new datum\length(strlen($value)))
							->once
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNIntegerIs($value)
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('nintegerIs')
						->withIdenticalArguments((int) (string) $value)
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
			new objectWith__toStringAsInteger
		];
	}

	protected function invalidValueProvider()
	{
		return [
			M_PI,
			(string) M_PI,
			'',
			false,
			true,
			null,
			new \stdClass
		];
	}

	protected function validNStringProvider()
	{
		return [
			'0',
			(string) PHP_INT_MIN,
			(string) PHP_INT_MAX,
			new objectWith__toStringAsInteger
		];
	}

	protected function invalidNStringProvider()
	{
		return [
			'',
			'1e9',
			(string) M_PI,
			'foobar',
			new objectWith__toStringAsNotInteger
		];
	}
}

class objectWith__toStringAsInteger
{
	function __toString()
	{
		return '666';
	}
}

class objectWith__toStringAsNotInteger
{
	function __toString()
	{
		return 'foobar';
	}
}
