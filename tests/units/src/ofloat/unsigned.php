<?php namespace estvoyage\risingsun\tests\units\ofloat;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class unsigned extends units\test
{
	function testClass()
	{
		$this->testedClass
			->isAbstract
			->extends('estvoyage\risingsun\ofloat')
		;
	}

	function testWithNoValue()
	{
		$this
			->castToString($this->newTestedInstance)->isEqualTo('0.0')
			->float($this->newTestedInstance->value)->isZero
		;
	}

	function testWithFloat()
	{
		$this
			->given(
				$float = M_PI
			)
			->if(
				$this->newTestedInstance($float)
			)
			->then
				->castToString($this->testedInstance)->isEqualTo((string) $float)
				->float($this->testedInstance->value)->isEqualTo($float)
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
				->hasMessage('Value should be a float greater than or equal to 0')
		;
	}

	protected function validValueProvider()
	{
		return [
			0.,
			(float) rand(1, PHP_INT_MAX),
			M_PI
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			[ [] ],
			new \stdclass,
			- M_PI,
			(float) rand(- PHP_INT_MAX, -1)
		];
	}
}
