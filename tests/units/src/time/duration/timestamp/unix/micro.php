<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ostring };
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ostring as mockOfOString, ointeger as mockOfOInteger, datum as mockOfDatum };

class micro extends units\test
{
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
						->never

			->if(
				$this->calling($precision)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(3);
				}
			)
			->then
				->object($this->testedInstance->recipientOfPartAtRightOfRadixWithPrecisionIs($precision, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any('0'))
							->once

			->if(
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
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			0.,
			rand(1, PHP_INT_MAX),
			M_PI,
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			1e9
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
}
