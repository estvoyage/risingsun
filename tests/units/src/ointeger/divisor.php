<?php namespace estvoyage\risingsun\tests\units\ointeger;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class divisor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValue($value)
	{
		$this
			->object($this->newTestedInstance($value))
				->castToString($this->testedInstance)
					->isEqualTo((int) $value)
			->integer($this->testedInstance->value)->isEqualTo((int) $value)
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
				->hasMessage('Divisor should be an integer not equal to 0')
		;
	}

	protected function validValueProvider()
	{
		return [
			rand(- PHP_INT_MAX, -1),
			rand(1, PHP_INT_MAX)
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			M_PI,
			[ [] ],
			new \stdclass,
			0,
			0.
		];
	}
}
