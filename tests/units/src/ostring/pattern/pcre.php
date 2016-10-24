<?php namespace estvoyage\risingsun\tests\units\ostring\pattern;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\ostring\pattern,
	mock\estvoyage\risingsun\hash as mockOfHash,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\ostring as mockOfOstring,
	mock\estvoyage\risingsun\ostring\pattern as mockOfPattern
;

class pcre extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring\notEmpty')
			->implements('estvoyage\risingsun\ostring\pattern')
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
				->message
					->match('/^Pattern \'' . $value . '\' is not a valid PCRE regular expression: .+$/')
		;
	}

	function testRecipientOfHashWithPatternDataFromStringIs()
	{
		$this
			->given(
				$recipient = new mockOfPattern\data\recipient,
				$hash = new mockOfHash,
				$string = new risingsun\ostring(uniqid())
			)

			->if(
				$this->newTestedInstance('/^' . $string . '$/')
			)
			->then
				->object($this->testedInstance->recipientOfHashWithPatternDataFromStringIs($hash, $string, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('hashContainsPatternDataFromString')
						->withArguments($hash, $string)
							->once

			->if(
				$this->newTestedInstance('/^(' . $string . ')$/')
			)
			->then
				->object($this->testedInstance->recipientOfHashWithPatternDataFromStringIs($hash, $string, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('hashContainsPatternDataFromString')
						->withArguments($hash, $string)
							->twice

			->given(
				$dataName = new hash\key(uniqid()),
				$hashWithData = new mockOfHash,
				$hashWithData->id = uniqid()
			)
			->if(
				$this->calling($hash)->recipientOfHashWithValueIs = function($value, $recipient) use ($string, $dataName, $hashWithData) {
					if ($value == new hash\value\withKey(new risingsun\ostring($string), $dataName))
					{
						$recipient->hashIs($hashWithData);
					}
				},

				$this->newTestedInstance('/^(' . $string . ')$/', $dataName)
			)
			->then
				->object($this->testedInstance->recipientOfHashWithPatternDataFromStringIs($hash, $string, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('hashContainsPatternDataFromString')
						->withArguments($hashWithData, $string)
							->once

			->given(
				$string = new risingsun\ostring('foo+bar'),
				$fooName = new hash\key('foo'),
				$barName = new hash\key('bar'),
				$hashWithFoo = new mockOfHash,
				$hashWithFoo->id = 'foo',
				$hashWithFooAndBar = new mockOfHash,
				$hashWithFooAndBar->id = 'foobar'
			)
			->if(
				$this->calling($hash)->recipientOfHashWithValueIs = function($value, $recipient) use ($string, $fooName, $hashWithFoo) {
					if ($value == new hash\value\withKey(new risingsun\ostring('foo'), $fooName))
					{
						$recipient->hashIs($hashWithFoo);
					}
				},

				$this->calling($hashWithFoo)->recipientOfHashWithValueIs = function($value, $recipient) use ($string, $barName, $hashWithFooAndBar) {
					if ($value == new hash\value\withKey(new risingsun\ostring('bar'), $barName))
					{
						$recipient->hashIs($hashWithFooAndBar);
					}
				},

				$this->newTestedInstance('/^(foo)\+(bar)$/', $fooName, $barName)
			)
			->then
				->object($this->testedInstance->recipientOfHashWithPatternDataFromStringIs($hash, $string, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('hashContainsPatternDataFromString')
						->withArguments($hashWithFooAndBar, $string)
							->once
		;
	}

	function testIfIsPatternOfString()
	{
		$this
			->given(
				$string = new risingsun\ostring(uniqid()),
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance('/' . $string . '/')
			)
			->then
				->object($this->testedInstance->ifIsPatternOfString(new risingsun\ostring, $block))
					->isEqualTo($this->newTestedInstance('/' . $string . '/'))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

				->object($this->testedInstance->ifIsPatternOfString($string, $block))
					->isEqualTo($this->newTestedInstance('/' . $string . '/'))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsNotPatternOfString()
	{
		$this
			->given(
				$string = new risingsun\ostring(uniqid()),
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance('/' . $string . '/')
			)
			->then
				->object($this->testedInstance->ifIsNotPatternOfString($string, $block))
					->isEqualTo($this->newTestedInstance('/' . $string . '/'))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

				->object($this->testedInstance->ifIsNotPatternOfString(new risingsun\ostring, $block))
					->isEqualTo($this->newTestedInstance('/' . $string . '/'))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	protected function invalidValueProvider()
	{
		return [
			uniqid(),
		];
	}
}
