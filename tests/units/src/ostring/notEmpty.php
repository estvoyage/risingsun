<?php namespace estvoyage\risingsun\tests\units\ostring;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\ostring,
	mock\estvoyage\risingsun\ostring as mockOfOString,
	estvoyage\risingsun\ostring\notEmpty as testedClass
;

class notEmpty extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValidValue($value)
	{
		$this->castToString($this->newTestedInstance($value))->isEqualTo($value);
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Value should be a not empty string')
		;
	}

	function testDefaultIfStringIsEmptyIs()
	{
		$this
			->object(testedClass::defaultIfStringIsEmptyIs(new ostring, $this->newTestedInstance(uniqid())))->isIdenticalTo($this->testedInstance)
			->object(testedClass::defaultIfStringIsEmptyIs(new ostring($value = uniqid()), $this->newTestedInstance(uniqid())))->isEqualTo($this->newTestedInstance($value))
		;
	}

	protected function validValueProvider()
	{
		return [
			uniqid(),
			$this->newTestedInstance(uniqid())
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			rand(- PHP_INT_MAX, 1),
			0,
			rand(1, PHP_INT_MAX),
			(float) rand(- PHP_INT_MAX, 1),
			0.,
			M_PI,
			(float) rand(1, PHP_INT_MAX)
			[ [] ],
			new \stdclass,
			''
		];
	}
}
