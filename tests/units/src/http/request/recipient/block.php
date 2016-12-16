<?php namespace estvoyage\risingsun\tests\units\http\request\recipient;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\request\recipient')
		;
	}

	function testHttpRequestIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->httpRequestIs($request))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($request)
							->once
		;
	}
}
