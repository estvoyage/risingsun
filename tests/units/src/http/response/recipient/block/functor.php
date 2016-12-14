<?php namespace estvoyage\risingsun\tests\units\http\response\recipient\block;

require __DIR__ . '/../../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\response\recipient')
		;
	}

	function testHttpResponseIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->httpResponseIs($response))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($response)
							->once
		;
	}
}
