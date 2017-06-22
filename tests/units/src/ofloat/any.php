<?php namespace estvoyage\risingsun\tests\units\ofloat;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, ostring, datum };
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
				$value = (float) rand(PHP_INT_MIN, PHP_INT_MAX),
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
				$childOfTestedClass = $this->childOfTestedClass()
			)
			->then
				->object($childOfTestedClass->recipientOfOFloatWithNFloatIs($value, $recipient))
					->isEqualTo($this->childOfTestedClass())
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments($this->childOfTestedClass($value))
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

	function testRecipientOfDatumFromDatum_withNoReplyFromDatum()
	{
		$this
			->given(
				$this->newTestedInstance,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumFromDatumIs($datum, $recipient)
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
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumFromDatumIs_withValidNString($nstring)
	{
		$this
			->given(
				$this->newTestedInstance,

				$datum = new mockOfDatum,
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($nstring) {
					$recipient->nstringIs($nstring);
				},

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
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNStringIs($value)
	{
		$this
			->given(
				$this->newTestedInstance($value),
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->testedInstance->recipientOfNStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments((string) $value)
							->once
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

//			->if(
//				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
//					$recipient->nintegerIs(3);
//				},
//				$this->newTestedInstance(1.345)
//			)
//			->then
//				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
//					->isEqualTo($this->newTestedInstance(1.345))
//				->mock($recipient)
//					->receive('datumIs')
//						->withArguments(new ostring\any('345'))
//							->once
//
//			->if(
//				$this->newTestedInstance(1.3456)
//			)
//			->then
//				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
//					->isEqualTo($this->newTestedInstance(1.3456))
//				->mock($recipient)
//					->receive('datumIs')
//						->withArguments(new ostring\any('345'))
//							->twice
//
//			->if(
//				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
//					$recipient->nintegerIs(5);
//				},
//
//				$this->newTestedInstance(1.2468)
//			)
//			->then
//				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
//					->isEqualTo($this->newTestedInstance(1.2468))
//				->mock($recipient)
//					->receive('datumIs')
//						->withArguments(new ostring\any('24680'))
//							->once
//
//			->if(
//				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
//					$recipient->nintegerIs(3);
//				},
//
//				$this->newTestedInstance(1e-5)
//			)
//			->then
//				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
//					->isEqualTo($this->newTestedInstance(1e-5))
//				->mock($recipient)
//					->receive('datumIs')
//						->withArguments(new ostring\any('000'))
//							->once
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
			rand(PHP_INT_MIN, -1),
			(string) rand(PHP_INT_MIN, -1),
			M_PI,
			(string) M_PI,
			- M_PI,
			(string) - M_PI
			- 1e9,
			'-1e9',
			1e9,
			'1e9'
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
			'-1e9',
			0x539,
			02471,
			'02471',
			0b10100111001
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
