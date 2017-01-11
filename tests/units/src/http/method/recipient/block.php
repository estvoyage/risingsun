<?php namespace estvoyage\risingsun\tests\units\http\method\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, http as mockOfHttp };

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\method\recipient')
		;
	}

	function testHttpMethodIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$method = new mockOfHttp\method
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->httpMethodIs($method))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($method)
							->once
		;
	}
}
