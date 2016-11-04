<?php namespace estvoyage\risingsun\tests\units\http\url\path;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http\url,
	estvoyage\risingsun\http\url\path\root as testedClass,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class root extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\http\url\path')
		;
	}

	function testIfIsEqualToHttpUrlPath()
	{
		$this
			->given(
				$isEqualBlock = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($this->newTestedInstance, $isEqualBlock))
					->isEqualTo($this->newTestedInstance)
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$path = new url\path(new risingsun\ostring\notEmpty('/'))
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($path, $isEqualBlock))
					->isEqualTo($this->newTestedInstance)
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice

			->given(
				$notIsEqualBlock = new mockOfBlock,
				$path = new url\path(new risingsun\ostring\notEmpty('/' . uniqid()))
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($path, $isEqualBlock, $notIsEqualBlock))
					->isEqualTo($this->newTestedInstance)
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->twice
				->mock($notIsEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
