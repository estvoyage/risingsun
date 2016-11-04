<?php namespace estvoyage\risingsun\tests\units\http\url;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http\url,
	estvoyage\risingsun\http\url\path as testedClass,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class path extends units\test
{
	/**
	 * @dataProvider invalidPcrePatternProvider
	 */
	function testWithInvalidPcrePatternValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance(new risingsun\ostring\notEmpty($value)); })
				->isInstanceOf('domainException')
				->hasMessage('HTTP URL path must match PCRE pattern `%^/(?:[^/#?]+(?:/[^/#?]+)*)?$%\'')
		;
	}

	function testIfIsEqualToHttpUrlPath()
	{
		$this
			->given(
				$isEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($this->newTestedInstance($path), $isEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$notIsEqualBlock = new mockOfBlock,
				$otherPath = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($this->newTestedInstance($otherPath), $isEqualBlock, $notIsEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($notIsEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testToString()
	{
		$this
			->given(
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object(testedClass::toString($this->testedInstance))->isEqualTo($path)
		;
	}

	protected function invalidPcrePatternProvider()
	{
		return [
			uniqid(),
			'/#',
			'/foo#',
			'/foo?',
			'/foo/',
			'/foo/bar/'
		];
	}
}
