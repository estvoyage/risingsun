<?php namespace estvoyage\risingsun\tests\units\ostring\pattern;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\ostring\pattern,
	mock\estvoyage\risingsun\ostring as mockOfOstring,
	mock\estvoyage\risingsun\ostring\pattern as mockOfPattern
;

class pcre extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring')
			->implements('estvoyage\risingsun\ostring\pattern')
		;
	}

	function testStringHasController()
	{
		$this
			->given(
				$controller = new mockOfPattern\controller,
				$recipient = new mockOfOstring\pattern\data\recipient,
				$string = new mockOfOstring
			)

			->assert('Controller receive stringMatchPattern message when string match')
			->if(
				$this->calling($string)->__toString = uniqid(),
				$this->newTestedInstance('/^' . $string . '$/')
			)
			->then
				->object($this->testedInstance->stringHasController($string, $controller))->isTestedInstance
				->mock($controller)
					->receive('stringMatchPattern')
						->withArguments(new pattern\match($string), $this->testedInstance)
							->once

			->given(
				$this->calling($recipient)->stringPatternDataHasName = $recipient,
				$this->calling($controller)->stringMatchPattern = function($string, $pattern) use ($recipient) { $pattern->recipientOfStringPatternDataIs($recipient); }
			)

			->if(
				$this->newTestedInstance('/^(' . $string . ')$/')
			)
			->then
				->object($this->testedInstance->stringHasController($string, $controller))->isTestedInstance
				->mock($recipient)
					->receive('stringPatternDataHasName')
						->never

			->if(
				$this->newTestedInstance('/^(' . $string . ')$/', $dataName = new pattern\data\name(uniqid()))
			)
			->then
				->object($this->testedInstance->stringHasController($string, $controller))->isTestedInstance
				->mock($recipient)
					->receive('stringPatternDataHasName')
						->withArguments(new pattern\data((string) $string), $dataName)
							->once

			->if(
				$this->newTestedInstance('/^(' . $string . ')$/', $dataName, $otherDataBName = new pattern\data\name(uniqid()))
			)
			->then
				->object($this->testedInstance->stringHasController($string, $controller))->isTestedInstance
				->mock($recipient)
					->receive('stringPatternDataHasName')
						->withArguments(new pattern\data((string) $string), $dataName)
							->twice

			->if(
				$this->newTestedInstance($pattern = uniqid(), $dataName = new pattern\data\name(uniqid()))
			)
			->then
				->exception(function() use ($string, $controller) { $this->testedInstance->stringHasController($string, $controller); })
					->isInstanceOf('domainException')
					->message
						->match('/^Pattern \'' . $pattern . '\' is not a valid PCRE regular expression: .+$/')
		;
	}

	function testRecipientOfStringDataIs()
	{
		$this
			->given(
				$recipient = new mockOfOstring\pattern\data\recipient
			)
			->if(
				$this->newTestedInstance('//')
			)
			->then
				->object($this->testedInstance->recipientOfStringPatternDataIs($recipient))->isTestedInstance
		;
	}
}
