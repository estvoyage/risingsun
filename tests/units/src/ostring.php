<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	mock\estvoyage\risingsun\ostring as mockOfOstring
;

class ostring extends units\test
{
	function testWithNoValue()
	{
		$this->castToString($this->newTestedInstance)->isEmpty;
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
				->hasMessage('Value should be a string')
		;
	}

	function testIfIsEmptyString()
	{
		$this
			->given(
				$emptyCallable = function() use (& $isEmpty) { $isEmpty = true; },
				$notEmptyCallable = function() use (& $isNotEmpty) { $isNotEmpty = true; },
				$isEmpty = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEmptyString($emptyCallable))->isTestedInstance
				->boolean($isEmpty)->isTrue

			->given(
				$this->newTestedInstance(uniqid()),
				$isEmpty = false,
				$isNotEmpty = false
			)
			->if(
				$this->testedInstance->ifIsEmptyString($emptyCallable, $notEmptyCallable)
			)
			->then
				->boolean($isEmpty)->isFalse
				->boolean($isNotEmpty)->isTrue
		;
	}

	function testIfIsNotEmptyString()
	{
		$this
			->given(
				$notEmptyCallable = function() use (& $isNotEmpty) { $isNotEmpty = true; },
				$emptyCallable = function() use (& $isEmpty) { $isEmpty = true; },
				$isNotEmpty = false
			)
			->if(
				$this->newTestedInstance(uniqid())
			)
			->then
				->object($this->testedInstance->ifIsNotEmptyString($notEmptyCallable))->isTestedInstance
				->boolean($isNotEmpty)->isTrue

			->given(
				$this->newTestedInstance,
				$isNotEmpty = false,
				$isEmpty = false
			)
			->if(
				$this->testedInstance->ifIsNotEmptyString($notEmptyCallable, $emptyCallable)
			)
			->then
				->boolean($isNotEmpty)->isFalse
				->boolean($isEmpty)->isTrue
		;
	}

	function testIfEqualToString()
	{
		$this
			->given(
				$equalCallable = function() use (& $isEqual) { $isEqual = true; },
				$notEqualCallable = function() use (& $isNotEqual) { $isNotEqual = true; },
				$string = $this->newTestedInstance(uniqid())
			)

			->assert('Empty string is equal to empty string')
			->if(
				$emptyString = $this->newTestedInstance,
				$isEqual = false
			)
			->then
				->object($this->newTestedInstance->ifEqualToString($emptyString, $equalCallable))->isTestedInstance
				->boolean($isEqual)->isTrue

			->assert('Not equal callable should be called if string are not equals')
			->if(
				$isEqual = false,
				$isNotEqual = false,
				$string->ifEqualToString($this->newTestedInstance(uniqid()), $equalCallable, $notEqualCallable)
			)
			->then
				->boolean($isEqual)->isFalse
				->boolean($isNotEqual)->isTrue

			->assert('Equal callable should be called if string are equals')
			->if(
				$isEqual = false,
				$isNotEqual = false,
				$string->ifEqualToString(clone $string, $equalCallable)
			)
			->then
				->boolean($isEqual)->isTrue
				->boolean($isNotEqual)->isFalse
		;
	}

	function testIfNotEqualToString()
	{
		$this
			->given(
				$equalCallable = function() use (& $isEqual) { $isEqual = true; },
				$notEqualCallable = function() use (& $isNotEqual) { $isNotEqual = true; },
				$string = $this->newTestedInstance(uniqid())
			)

			->assert('Empty string is equal to empty string')
			->if(
				$emptyString = $this->newTestedInstance,
				$isNotEqual = false
			)
			->then
				->object($this->newTestedInstance->ifNotEqualToString($emptyString, $notEqualCallable))->isTestedInstance
				->boolean($isNotEqual)->isFalse

			->assert('Not equal callable should be called if string are not equals')
			->if(
				$isNotEqual = false,
				$string->ifNotEqualToString($this->newTestedInstance(uniqid()), $notEqualCallable)
			)
			->then
				->boolean($isNotEqual)->isTrue

			->assert('Equal callable should be called if string are equals')
			->if(
				$isEqual = false,
				$isNotEqual = false,
				$string->ifNotEqualToString(clone $string, $notEqualCallable, $equalCallable)
			)
			->then
				->boolean($isEqual)->isTrue
				->boolean($isNotEqual)->isFalse
		;
	}

	function testIfIsStartOfString()
	{
		$this
			->given(
				$isStartOfStringCallable = function() use (& $isStartOfString) { $isStartOfString = true; },
				$isNotStartOfStringCallable = function() use (& $isNotStartOfString) { $isNotStartOfString = true; }
			)
			->assert('Emtpy string can not be the start of an empty string')
			->if(
				$emptyString = $this->newTestedInstance,
				$isStartOfString = false,
				$isNotStartOfString = false
			)
			->then
				->object($this->newTestedInstance->ifIsStartOfString($emptyString, $isStartOfStringCallable, $isNotStartOfStringCallable))->isTestedInstance
				->boolean($isStartOfString)->isFalse
				->boolean($isNotStartOfString)->isTrue

			->assert('Emtpy string can not be the start of a string')
			->if(
				$string = $this->newTestedInstance(uniqid()),
				$isStartOfString = false,
				$isNotStartOfString = false,
				$this->newTestedInstance->ifIsStartOfString($string, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isFalse
				->boolean($isNotStartOfString)->isTrue

			->assert('String can not be the start of an empty string')
			->if(
				$isStartOfString = false,
				$isNotStartOfString = false,
				$this->newTestedInstance(uniqid())->ifIsStartOfString($emptyString, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isFalse
				->boolean($isNotStartOfString)->isTrue

			->assert('"foo" is start of "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$isStartOfString = false,
				$isNotStartOfString = false,
				$foo->ifIsStartOfString($foo, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isTrue
				->boolean($isNotStartOfString)->isFalse

			->assert('"foo" is start of "foobar"')
			->if(
				$foobar = $this->newTestedInstance('foobar'),
				$isStartOfString = false,
				$isNotStartOfString = false,
				$this->newTestedInstance('foo')->ifIsStartOfString($foobar, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isTrue
				->boolean($isNotStartOfString)->isFalse

			->assert('"foobar" is not the start of "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$isStartOfString = false,
				$isNotStartOfString = false,
				$this->newTestedInstance('foobar')->ifIsStartOfString($foo, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isFalse
				->boolean($isNotStartOfString)->isTrue

			->assert('"Foo" is not the start of "foo"')
			->if(
				$Foo = $this->newTestedInstance('Foo'),
				$isStartOfString = false,
				$isNotStartOfString = false,
				$this->newTestedInstance('foo')->ifIsStartOfString($Foo, $isStartOfStringCallable, $isNotStartOfStringCallable)
			)
			->then
				->boolean($isStartOfString)->isFalse
				->boolean($isNotStartOfString)->isTrue
		;
	}

	function testIfStartWithString()
	{
		$this
			->given(
				$startWithStringCallable = function() use (& $startWithString) { $startWithString = true; },
				$notStartWithStringCallable = function() use (& $notStartWithString) { $notStartWithString = true; }
			)

			->assert('Emtpy string can not start an empty string')
			->if(
				$emptyString = $this->newTestedInstance,
				$startWithString = false,
				$notStartWithString = false
			)
			->then
				->object($this->newTestedInstance->ifStartWithString($emptyString, $startWithStringCallable, $notStartWithStringCallable))->isTestedInstance
				->boolean($startWithString)->isFalse
				->boolean($notStartWithString)->isTrue

			->assert('Emtpy string can not start a string')
			->if(
				$string = $this->newTestedInstance(uniqid()),
				$startWithString = false,
				$notStartWithString = false,
				$this->newTestedInstance->ifStartWithString($string, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isFalse
				->boolean($notStartWithString)->isTrue

			->assert('String can not start an empty string')
			->if(
				$startWithString = false,
				$notStartWithString = false,
				$this->newTestedInstance(uniqid())->ifStartWithString($emptyString, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isFalse
				->boolean($notStartWithString)->isTrue

			->assert('"foo" start "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$startWithString = false,
				$notStartWithString = false,
				$foo->ifStartWithString($foo, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isTrue
				->boolean($notStartWithString)->isFalse

			->assert('"foo" start "foobar"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$startWithString = false,
				$notStartWithString = false,
				$this->newTestedInstance('foobar')->ifStartWithString($foo, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isTrue
				->boolean($notStartWithString)->isFalse

			->assert('"foobar" not start "foo"')
			->if(
				$foobar = $this->newTestedInstance('foobar'),
				$startWithString = false,
				$notStartWithString = false,
				$this->newTestedInstance('foo')->ifStartWithString($foobar, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isFalse
				->boolean($notStartWithString)->isTrue

			->assert('"Foobar" not start "foo"')
			->if(
				$Foobar = $this->newTestedInstance('Foobar'),
				$startWithString = false,
				$notStartWithString = false,
				$this->newTestedInstance('foo')->ifStartWithString($Foobar, $startWithStringCallable, $notStartWithStringCallable)
			)
			->then
				->boolean($startWithString)->isFalse
				->boolean($notStartWithString)->isTrue
		;
	}

	function testIfIsInteger()
	{
		$this
			->given(
				$isIntegerCallable = function() use (& $isInteger) { $isInteger = true; },
				$isNotIntegerCallable = function() use (& $isNotInteger) { $isNotInteger = true; }
			)

			->assert('Emtpy string is not an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isFalse
				->boolean($isNotInteger)->isTrue

			->assert('"foo" is not an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance('foo')->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isFalse
				->boolean($isNotInteger)->isTrue

			->assert('"0" is an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance('0')->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isTrue
				->boolean($isNotInteger)->isFalse

			->assert('Any integer is an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance((string) rand(- PHP_INT_MAX, PHP_INT_MAX))->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isTrue
				->boolean($isNotInteger)->isFalse

			->assert('PI is not an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance((string) M_PI)->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isFalse
				->boolean($isNotInteger)->isTrue

			->assert('Any string is not an integer')
			->if(
				$isInteger = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance('x' . uniqid())->ifIsInteger($isIntegerCallable, $isNotIntegerCallable))->isTestedInstance
				->boolean($isInteger)->isFalse
				->boolean($isNotInteger)->isTrue
		;
	}

	function testIfIsNotNumeric()
	{
		$this
			->given(
				$isNotNumericCallable = function() use (& $isNotNumeric) { $isNotNumeric = true; },
				$isNumericCallable = function() use (& $isNumeric) { $isNumeric = true; }
			)

			->assert('Emtpy string is not numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isTrue
				->boolean($isNumeric)->isFalse

			->assert('"foo" is not numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance('foo')->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isTrue
				->boolean($isNumeric)->isFalse

			->assert('"0" is a numeric')
			->if(
				$isNotNumeric = false,
				$isNotInteger = false
			)
			->then
				->object($this->newTestedInstance('0')->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isFalse
				->boolean($isNumeric)->isTrue

			->assert('Any integer is numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance((string) rand(- PHP_INT_MAX, PHP_INT_MAX))->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isFalse
				->boolean($isNumeric)->isTrue

			->assert('PI is numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance((string) M_PI)->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isFalse
				->boolean($isNumeric)->isTrue

			->assert('A string which begin with a number and followed by letter is not numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance(rand(1, PHP_INT_MAX) . 'x')->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isTrue
				->boolean($isNumeric)->isFalse

			->assert('Any string is not numeric')
			->if(
				$isNotNumeric = false,
				$isNumeric = false
			)
			->then
				->object($this->newTestedInstance('x' . uniqid())->ifIsNotNumeric($isNotNumericCallable, $isNumericCallable))->isTestedInstance
				->boolean($isNotNumeric)->isTrue
				->boolean($isNumeric)->isFalse
		;
	}

	function testOstringOffsetIs()
	{
		$this
			->given(
				$offset = new risingsun\ostring\offset(1)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ostringOffsetIs($offset))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance('1'))

			->given(
				$offset = new risingsun\ostring\offset(2)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ostringOffsetIs($offset))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance('2'))

			->given(
				$offset = new risingsun\ostring\offset(2)
			)
			->if(
				$this->newTestedInstance('a')
			)
			->then
				->object($this->testedInstance->ostringOffsetIs($offset))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance('c'))

			->if(
				$this->newTestedInstance('/')
			)
			->then
				->object($this->testedInstance->ostringOffsetIs($offset))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance('/'))
		;
	}

	function testRecipientOfStringLenghtIs()
	{
		$this
			->given(
				$recipient = new mockOfOstring\length\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfStringLengthIs($recipient))->isTestedInstance
				->mock($recipient)
					->receive('stringLengthIs')
						->withArguments(new risingsun\ostring\length)
							->once

			->if(
				$this->newTestedInstance('a')->recipientOfStringLengthIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('stringLengthIs')
						->withArguments(new risingsun\ostring\length(1))
							->once
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testValueIsWithInvalidValueProvider($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance->valueIs($value); })
				->isInstanceOf('domainException')
				->hasMessage('Value should be a string')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testValueIsWithValidValueProvider($value)
	{
		$this->castToString($this->newTestedInstance->valueIs($value))->isEqualTo($value);
	}

	protected function validValueProvider()
	{
		return [
			'',
			uniqid(),
			$this->newTestedInstance
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
			new \stdclass
		];
	}
}
