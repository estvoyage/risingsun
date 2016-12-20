<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\ostring as testedInstance,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\ostring as mockOfOString
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

	function testIfIsEmptyString()
	{
		$this
			->given(
				$blockIfEmpty = new mockOfBlock,
				$blockIfNotEmpty = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEmptyString($blockIfEmpty))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->if(
				$this->newTestedInstance($value = uniqid())
			)
			->then
				->object($this->testedInstance->ifIsEmptyString($blockIfEmpty))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

				->object($this->testedInstance->ifIsEmptyString($blockIfEmpty, $blockIfNotEmpty))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($blockIfNotEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsNotEmptyString()
	{
		$this
			->given(
				$blockIfNotEmpty = new mockOfBlock,
				$blockIfEmpty = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($value = uniqid())
			)
			->then
				->object($this->testedInstance->ifIsNotEmptyString($blockIfNotEmpty))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfNotEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsNotEmptyString($blockIfNotEmpty))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfNotEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

				->object($this->testedInstance->ifIsNotEmptyString($blockIfNotEmpty, $blockIfEmpty))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfNotEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($blockIfEmpty)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsEqualToString()
	{
		$this
			->given(
				$blockIfEqual = new mockOfBlock,
				$blockIfNotEqual = new mockOfBlock
			)

			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToString($this->testedInstance, $blockIfEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfEqual)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

				->object($this->testedInstance->ifIsEqualToString($this->newTestedInstance(uniqid()), $blockIfEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfEqual)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

				->object($this->testedInstance->ifIsEqualToString($this->newTestedInstance(uniqid()), $blockIfEqual, $blockIfNotEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfEqual)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($blockIfNotEqual)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsNotEqualToString()
	{
		$this
			->given(
				$blockIfEqual = new mockOfBlock,
				$blockIfNotEqual = new mockOfBlock
			)

			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsNotEqualToString($this->testedInstance, $blockIfNotEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfNotEqual)
					->receive('blockArgumentsAre')
						->never

				->object($this->testedInstance->ifIsNotEqualToString($this->testedInstance, $blockIfNotEqual, $blockIfEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfNotEqual)
					->receive('blockArgumentsAre')
						->never
				->mock($blockIfEqual)
					->receive('blockArgumentsAre')
						->once

				->object($this->testedInstance->ifIsNotEqualToString($this->newTestedInstance(uniqid()), $blockIfNotEqual, $blockIfEqual))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfNotEqual)
					->receive('blockArgumentsAre')
						->once
				->mock($blockIfEqual)
					->receive('blockArgumentsAre')
						->once
		;
	}

	function testIfIsStartOfString()
	{
		$this
			->given(
				$isStartOfStringBlock = new mockOfBlock,
				$isNotStartOfStringBlock = new mockOfBlock
			)
			->assert('Emtpy string can not be the start of an empty string')
			->if(
				$emptyString = $this->newTestedInstance
			)
			->then
				->object($this->newTestedInstance->ifIsStartOfString($emptyString, $isStartOfStringBlock, $isNotStartOfStringBlock))->isTestedInstance
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('Emtpy string can not be the start of a string')
			->if(
				$string = $this->newTestedInstance(uniqid()),
				$this->newTestedInstance->ifIsStartOfString($string, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('String can not be the start of an empty string')
			->if(
				$this->newTestedInstance(uniqid())->ifIsStartOfString($emptyString, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('"foo" is start of "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$foo->ifIsStartOfString($foo, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->assert('"foo" is start of "foobar"')
			->if(
				$foobar = $this->newTestedInstance('foobar'),
				$this->newTestedInstance('foo')->ifIsStartOfString($foobar, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->assert('"foobar" is not the start of "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$this->newTestedInstance('foobar')->ifIsStartOfString($foo, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('"Foo" is not the start of "foo"')
			->if(
				$Foo = $this->newTestedInstance('Foo'),
				$this->newTestedInstance('foo')->ifIsStartOfString($Foo, $isStartOfStringBlock, $isNotStartOfStringBlock)
			)
			->then
				->mock($isStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($isNotStartOfStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfStartWithString()
	{
		$this
			->given(
				$startWithStringBlock = new mockOfBlock,
				$notStartWithStringBlock = new mockOfBlock
			)

			->assert('Emtpy string can not start an empty string')
			->if(
				$emptyString = $this->newTestedInstance
			)
			->then
				->object($this->newTestedInstance->ifStartWithString($emptyString, $startWithStringBlock, $notStartWithStringBlock))->isTestedInstance
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('Emtpy string can not start a string')
			->if(
				$string = $this->newTestedInstance(uniqid()),
				$this->newTestedInstance->ifStartWithString($string, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('String can not start an empty string')
			->if(
				$this->newTestedInstance(uniqid())->ifStartWithString($emptyString, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('"foo" start "foo"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$foo->ifStartWithString($foo, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->assert('"foo" start "foobar"')
			->if(
				$foo = $this->newTestedInstance('foo'),
				$this->newTestedInstance('foobar')->ifStartWithString($foo, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->assert('"foobar" not start "foo"')
			->if(
				$foobar = $this->newTestedInstance('foobar'),
				$this->newTestedInstance('foo')->ifStartWithString($foobar, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->assert('"Foobar" not start "foo"')
			->if(
				$Foobar = $this->newTestedInstance('Foobar'),
				$this->newTestedInstance('foo')->ifStartWithString($Foobar, $startWithStringBlock, $notStartWithStringBlock)
			)
			->then
				->mock($startWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
				->mock($notStartWithStringBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsInteger()
	{
		$this
			->given(
				$isIntegerBlock = new mockOfBlock,
				$isNotIntegerBlock = new mockOfBlock
			)

			->assert('Emtpy string is not an integer')
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->never
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->once

			->assert('"foo" is not an integer')
			->if(
				$this->newTestedInstance('foo')
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->never
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->once

			->assert('"0" is an integer')
			->if(
				$this->newTestedInstance('0')
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->once
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->never

			->assert('Any integer is an integer')
			->if(
				$this->newTestedInstance((string) rand(- PHP_INT_MAX, PHP_INT_MAX))
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->once
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->never

			->assert('PI is not an integer')
			->if(
				$this->newTestedInstance((string) M_PI)
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->never
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->once

			->assert('Any string is not an integer')
			->if(
				$this->newTestedInstance('x' . uniqid())
			)
			->then
				->object($this->testedInstance->ifIsInteger($isIntegerBlock, $isNotIntegerBlock))->isTestedInstance
				->mock($isIntegerBlock)
					->receive('blockArgumentsAre')
						->never
				->mock($isNotIntegerBlock)
					->receive('blockArgumentsAre')
						->once
		;
	}

	function testIfIsNotNumeric()
	{
		$this
			->given(
				$blockIfIsNotNumeric = new mockOfBlock,
				$blockIfIsNumeric = new mockOfBlock
			)

			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance)
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$this->newTestedInstance('foo')
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance('foo'))
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$this->newTestedInstance('0')
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance('0'))
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->if(
				$this->newTestedInstance($value = (string) rand(- PHP_INT_MAX, PHP_INT_MAX))
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice

			->if(
				$this->newTestedInstance($value = rand(- PHP_INT_MAX, PHP_INT_MAX) . 'x')
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->thrice
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice

			->if(
				$this->newTestedInstance($value = 'x' . rand(- PHP_INT_MAX, PHP_INT_MAX))
			)
			->then
				->object($this->testedInstance->ifIsNotNumeric($blockIfIsNotNumeric, $blockIfIsNumeric))
					->isEqualTo($this->newTestedInstance($value))
				->mock($blockIfIsNotNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->{4}
				->mock($blockIfIsNumeric)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice
		;
	}

	function testRecipientOfStringLenghtIs()
	{
		$this
			->given(
				$recipient = new mockOfOString\length\recipient
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

	function testRecipientOfStringBeforeLastStringIs()
	{
		$this
			->given(
				$lastString = new risingsun\ostring\notEmpty(uniqid()),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$lastString = new risingsun\ostring\notEmpty('/'),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance('/')
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance('/'))
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$string = uniqid()
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$string = 'foobar',
				$lastString = new risingsun\ostring\notEmpty('bar')
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('foo'))
							->once

			->given(
				$string = 'foobarbar'
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('foobar'))
							->once

			->given(
				$string = 'foobarBar'
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringBeforeLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('foobar'))
							->once
		;
	}

	function testRecipientOfStringAfterLastStringIs()
	{
		$this
			->given(
				$lastString = new risingsun\ostring\notEmpty(uniqid()),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfStringAfterLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$lastString = new risingsun\ostring\notEmpty('/'),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance('/')
			)
			->then
				->object($this->testedInstance->recipientOfStringAfterLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance('/'))
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$string = uniqid()
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringAfterLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->never

			->given(
				$string = 'foobar',
				$lastString = new risingsun\ostring\notEmpty('foo')
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringAfterLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('bar'))
							->once

			->given(
				$string = 'foobarfoobarbar'
			)
			->if(
				$this->newTestedInstance($string)
			)
			->then
				->object($this->testedInstance->recipientOfStringAfterLastStringIs($lastString, $recipient))
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('barbar'))
							->once
		;
	}

	function testRecipientOfStringWithoutPrefixIs()
	{
		$this
			->given(
				$prefix = new risingsun\ostring\notEmpty('foo'),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfStringWithoutPrefixIs($prefix, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->never

			->if(
				$this->newTestedInstance('foo')
			)
			->then
				->object($this->testedInstance->recipientOfStringWithoutPrefixIs($prefix, $recipient))
					->isEqualTo($this->newTestedInstance('foo'))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance)
							->once

			->if(
				$this->newTestedInstance('foobar')
			)
			->then
				->object($this->testedInstance->recipientOfStringWithoutPrefixIs($prefix, $recipient))
					->isEqualTo($this->newTestedInstance('foobar'))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('bar'))
							->once

			->if(
				$this->newTestedInstance('oofbar')
			)
			->then
				->object($this->testedInstance->recipientOfStringWithoutPrefixIs($prefix, $recipient))
					->isEqualTo($this->newTestedInstance('oofbar'))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('bar'))
							->once
		;
	}

	function testRecipientOfStringWithSuffixIs()
	{
		$this
			->given(
				$suffix = new risingsun\ostring\notEmpty('bar'),
				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfStringWithSuffixIs($suffix, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('bar'))
							->once

			->if(
				$this->newTestedInstance('foo')
			)
			->then
				->object($this->testedInstance->recipientOfStringWithSuffixIs($suffix, $recipient))
					->isEqualTo($this->newTestedInstance('foo'))
				->mock($recipient)
					->receive('ostringIs')
						->withArguments($this->newTestedInstance('foobar'))
							->once
		;
	}

	function testCopy()
	{
		$this
			->given(
				$origin = $this->newTestedInstance
			)
			->if(
				$destination = $this->newTestedInstance
			)
			->then
				->object(testedInstance::copy($origin, $destination))
					->IsNotIdenticalTo($origin)
					->IsNotIdenticalTo($destination)
					->isEqualTo($this->newTestedInstance)

			->if(
				$destination = $this->newTestedInstance('foo')
			)
			->then
				->object(testedInstance::copy($origin, $destination))
					->isEqualTo($this->newTestedInstance)

			->given(
				$origin = $this->newTestedInstance('bar')
			)
			->if(
				$destination = $this->newTestedInstance('foo')
			)
			->then
				->object(testedInstance::copy($origin, $destination))
					->isEqualTo($this->newTestedInstance('bar'))
		;
	}

	protected function validValueProvider()
	{
		return [
			'',
			uniqid(),
			$this->newTestedInstance
		];
	}
}
