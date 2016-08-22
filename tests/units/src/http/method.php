<?php namespace estvoyage\risingsun\tests\units\http;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class method extends units\test
{
	function testIfIsEqualToHttpMethod()
	{
		$this
			->given(
				$boolean = false,
				$callable = function() use (& $boolean) { $boolean = true; },
				$value = new risingsun\ostring\notEmpty(uniqid())
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpMethod(new http\method(new risingsun\ostring\notEmpty(uniqid())), $callable))
					->isEqualTo($this->newTestedInstance($value))
				->boolean($boolean)->isFalse

				->object($this->testedInstance->ifIsEqualToHttpMethod($this->testedInstance, $callable))
					->isEqualTo($this->newTestedInstance($value))
				->boolean($boolean)->isTrue
		;
	}
}
