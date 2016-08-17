<?php namespace estvoyage\risingsun\tests\units\ointeger\divisor;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class unsigned extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger\divisor')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValidValue($value)
	{
		$this
			->object($this->newTestedInstance($value))
				->castToString($this->testedInstance)
					->isEqualTo($value)
			->integer($this->testedInstance->value)->isEqualTo($value)
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Unsigned divisor must be an integer greater than 0')
		;
	}

	protected function validValueProvider()
	{
		return [
			1,
			rand(2, PHP_INT_MAX),
			1.,
			(float) rand(2, PHP_INT_MAX)
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			rand(- PHP_INT_MAX, -1),
			(float) rand(- PHP_INT_MAX, -1),
			M_PI,
			[ [] ],
			new \stdclass,
			0,
			0.
		];
	}
}
