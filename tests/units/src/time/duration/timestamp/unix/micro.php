<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ostring, ointeger };
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ostring as mockOfOString, ointeger as mockOfOInteger, datum as mockOfDatum, nstring as mockOfNString, oboolean as mockOfOBoolean };

class micro extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
		;
	}

	function testWithNoValue()
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
						->withIdenticalArguments((float) $value)
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
						->withIdenticalArguments((string) $value)
							->once
		;
	}

	/**
	 * @dataProvider validNStringProvider
	 */
	function testRecipientOfDatumWithValueIs_withValidNString($nstring)
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
		;
	}

	/**
	 * @dataProvider invalidNStringProvider
	 */
	function testRecipientOfDatumWithValueIs_withInvalidNString($nstring)
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
						->never
		;
	}

	function testRecipientOfPartAtRightOfRadixIs()
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
						->withArguments($this->testedInstance, $recipient)
							->once
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
						->withArguments(new ointeger\unsigned\any(1), $recipient)
							->once

			->if(
				$this->newTestedInstance(M_PI)
			)
			->then
				->object($this->testedInstance->recipientOfDatumLengthComparisonIs($comparison, $recipient))
					->isEqualTo($this->newTestedInstance(M_PI))
				->mock($comparison)
					->receive('recipientOfDatumLengthComparisonWithDatumLengthIs')
						->withArguments(new ointeger\unsigned\any(strlen(M_PI)), $recipient)
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
