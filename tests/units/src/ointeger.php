<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units
;

class ointeger extends units\test
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
				->hasMessage('Value should be an integer')
		;
	}

	function testIfIsLessThan()
	{
		$this
			->given(
				$integer = $this->newTestedInstance,
				$isLessThan = function() use (& $less) { $less = true; }
			)
			->if(
				$this->newTestedInstance,
				$less = false
			)
			->then
				->object($this->testedInstance->ifIsLessThan($integer, $isLessThan))->isTestedInstance
				->boolean($less)->isFalse

			->if(
				$this->newTestedInstance(-1)->ifIsLessThan($integer, $isLessThan)
			)
			->then
				->boolean($less)->isTrue

			->given(
				$isNotLessThan = function() use (& $notLess) { $notLess = true; }
			)
			->if(
				$this->newTestedInstance->ifIsLessThan($integer, $isLessThan, $isNotLessThan)
			)
			->then
				->boolean($notLess)->isTrue
		;
	}

	function testIfIsEqualTo()
	{
		$this
			->given(
				$integer = $this->newTestedInstance,
				$isEqualTo = function() use (& $equal) { $equal = true; },
				$equal = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualTo($this->testedInstance, $isEqualTo))->isTestedInstance
				->boolean($equal)->isTrue

			->given(
				$equal = false
			)
			->if(
				$this->newTestedInstance(-1)->ifIsEqualTo($this->newTestedInstance, $isEqualTo)
			)
			->then
				->boolean($equal)->isFalse

			->given(
				$isNotEqualTo = function() use (& $notEqual) { $notEqual = true; }
			)
			->if(
				$this->newTestedInstance(-1)->ifIsEqualTo($this->newTestedInstance, $isEqualTo, $isNotEqualTo)
			)
			->then
				->boolean($notEqual)->isTrue
		;
	}

	function testWhileIsGreaterThan()
	{
		$this
			->given(
				$i = 0,
				$integer = $this->newTestedInstance,
				$callable = function() use (& $i) { $i++; }
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($integer, $callable))->isTestedInstance
				->integer($i)->isZero

			->given(
				$i = 0,
				$integer = $this->newTestedInstance
			)
			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($integer, $callable))->isTestedInstance
				->integer($i)->isEqualTo(1)

			->given(
				$i = 0,
				$integer = $this->newTestedInstance
			)
			->if(
				$this->newTestedInstance(2)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($integer, $callable))->isTestedInstance
				->integer($i)->isEqualTo(2)

			->given(
				$i = 0,
				$integer = $this->newTestedInstance(1)
			)
			->if(
				$this->newTestedInstance(2)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($integer, $callable))->isTestedInstance
				->integer($i)->isEqualTo(1)
		;
	}

	function testWhileIsGreaterThanZero()
	{
		$this
			->given(
				$i = 0,
				$callable = function() use (& $i) { $i++; }
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->whileIsGreaterThanZero($callable))->isTestedInstance
				->integer($i)->isZero

			->given(
				$i = 0
			)
			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThanZero($callable))->isTestedInstance
				->integer($i)->isEqualTo(1)

			->given(
				$i = 0
			)
			->if(
				$this->newTestedInstance(2)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThanZero($callable))->isTestedInstance
				->integer($i)->isEqualTo(2)
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			rand(- PHP_INT_MAX, -1),
			rand(1, PHP_INT_MAX),
			0.,
			(float) rand(- PHP_INT_MAX, -1),
			(float) rand(1, PHP_INT_MAX)
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
			new \stdclass
		];
	}
}
