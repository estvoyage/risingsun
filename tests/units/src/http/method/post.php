<?php namespace estvoyage\risingsun\tests\units\http\method;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class post extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\http\method')
		;
	}

	function testIfIsEqualToHttpMethod()
	{
		$this
			->given(
				$boolean = false,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpMethod(new http\method(new risingsun\ostring\notEmpty(uniqid())), $block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

				->object($this->testedInstance->ifIsEqualToHttpMethod(new http\method(new risingsun\ostring\notEmpty('POST')), $block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
