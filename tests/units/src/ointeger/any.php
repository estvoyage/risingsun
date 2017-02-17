<?php namespace estvoyage\risingsun\tests\units\ointeger;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger')
		;
	}

	function testWithNoValue()
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance
					->recipientOfNIntegerIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(0)
							->once
		;
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

	function testRecipientOfOIntegerWithValueIs()
	{
		$this
			->given(
				$value = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($this->newTestedInstance($value))
							->once

			->if(
				$childOfTestedClass = new childOfTestedClass
			)
			->then
				->object($childOfTestedClass->recipientOfOIntegerWithValueIs($value, $recipient))
					->isEqualTo($childOfTestedClass)
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments(new childOfTestedClass($value))
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
}

class objectWith__toStringAsInteger
{
	function __toString()
	{
		return '666';
	}
}
