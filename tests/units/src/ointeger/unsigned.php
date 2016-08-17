<?php namespace estvoyage\risingsun\tests\units\ointeger;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class unsigned extends units\test
{
	function testWithNoValue()
	{
		$this
			->castToString($this->newTestedInstance)->isEqualTo('0')
			->integer($this->newTestedInstance->value)->isZero
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
				->hasMessage('Value should be an integer greater than or equal to 0')
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			rand(1, PHP_INT_MAX),
			0.,
			(float) rand(1, PHP_INT_MAX),
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
		];
	}
}
