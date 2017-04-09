<?php namespace estvoyage\risingsun\tests\units\ointeger\unsigned;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\ninteger as mockOfNInteger;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\unsigned')
			->implements('estvoyage\risingsun\datum')
		;
	}

	function testWithNoValue()
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
				->hasMessage('Value should be an unsigned integer')
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			PHP_INT_MAX,
			'0',
			(string) PHP_INT_MAX,
			new objectWith__toStringAsInteger
		];
	}

	protected function invalidValueProvider()
	{
		return [
			M_PI,
			- M_PI,
			(string) M_PI,
			(string) - M_PI,
			'',
			false,
			true,
			null,
			new \stdClass,
			rand(PHP_INT_MIN, -1),
			(string) rand(PHP_INT_MIN, -1),
			new objectWith__toStringAsInvalidInteger
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
}

class objectWith__toStringAsInteger
{
	function __toString()
	{
		return '666';
	}
}

class objectWith__toStringAsInvalidInteger
{
	function __toString()
	{
		return '-666';
	}
}

class objectWith__toStringAsNotInteger
{
	function __toString()
	{
		return 'foobar';
	}
}
