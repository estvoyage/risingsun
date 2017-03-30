<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ostring, ointeger };
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ointeger as mockOfOInteger, datum as mockOfDatum, nstring as mockOfNString, time\duration\timestamp\unix as mockOfUnix };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro')
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
						->withArguments((float) $value)
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

	function testRecipientOfPartAtRightOfRadixWithPrecisionIs()
	{
		$this
			->given(
				$recipient = new mockOfDatum\recipient,
				$precision = new mockOfOInteger\unsigned
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('0'))
							->once

			->if(
				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				},
				$this->newTestedInstance(1.345)
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance(1.345))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('345'))
							->once

			->if(
				$this->newTestedInstance(1.3456)
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance(1.3456))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('345'))
							->twice

			->if(
				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(5);
				},

				$this->newTestedInstance(1.2468)
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance(1.2468))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('24680'))
							->once

			->if(
				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				},

				$this->newTestedInstance(1e-5)
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance(1e-5))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('000'))
							->once
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfDatumLength($value)
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

	function testRecipientOfMicroUnixTimestampWithNFloatIs()
	{
		$this
			->given(
				$nfloat = M_PI,
				$recipient = new mockOfUnix\micro\recipient
			)
			->if(
				$this->newTestedInstance(0.)
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampWithNFloatIs($nfloat, $recipient))
					->isEqualTo($this->newTestedInstance(0.))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($this->newTestedInstance(M_PI))
							->once

			->if(
				$testedInstance = new childOfTestedClass(0.)
			)
			->then
				->object($testedInstance->recipientOfMicroUnixTimestampWithNFloatIs($nfloat, $recipient))
					->isEqualTo(new childOfTestedClass(0.))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments(new childOfTestedClass(M_PI))
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			0.,
			rand(1, PHP_INT_MAX),
			M_PI,
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
			new \stdclass,
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			- M_PI,
			(string) - M_PI
			- 1e9
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
			'',
			'foobar',
			(string) rand(- PHP_INT_MAX, -1),
			(string) - M_PI,
			'-1e9'
		];
	}
}
