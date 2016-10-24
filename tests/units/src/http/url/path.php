<?php namespace estvoyage\risingsun\tests\units\http\url;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun
;

class path extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring')
		;
	}

	function testWithValidValue()
	{
		$this
			->castToString($this->newTestedInstance)->isEqualTo('/')
			->castToString($this->newTestedInstance(new risingsun\ostring\notEmpty('/')))->isEqualTo('/')
		;
	}

	/**
	 * @dataProvider invalidPcrePatternProvider
	 */
	function testWithInvalidPcrePatternValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance(new risingsun\ostring\notEmpty($value)); })
				->isInstanceOf('domainException')
				->hasMessage('HTTP URL path must match PCRE pattern \`^/(?:[^/#?](?:/[^/#?])*)?$\'')
		;
	}

	protected function invalidPcrePatternProvider()
	{
		return [
			uniqid(),
			'/#',
			'/foo#',
			'/foo'
		];
	}
}
