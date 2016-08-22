<?php namespace estvoyage\risingsun\tests\units\http\method;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http
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
				$callable = function() use (& $boolean) { $boolean = true; }
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpMethod(new http\method(new risingsun\ostring\notEmpty(uniqid())), $callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($boolean)->isFalse

				->object($this->testedInstance->ifIsEqualToHttpMethod($this->newTestedInstance, $callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($boolean)->isTrue
		;
	}
}
