<?php namespace estvoyage\risingsun\tests\units\http;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class method extends units\test
{
	function testIfIsEqualToHttpMethod()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$value = new risingsun\ostring\notEmpty(uniqid())
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpMethod(new http\method(new risingsun\ostring\notEmpty(uniqid())), $block))
					->isEqualTo($this->newTestedInstance($value))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

				->object($this->testedInstance->ifIsEqualToHttpMethod($this->testedInstance, $block))
					->isEqualTo($this->newTestedInstance($value))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
