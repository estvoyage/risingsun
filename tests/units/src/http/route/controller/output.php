<?php namespace estvoyage\risingsun\tests\units\http\route\controller;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class output extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route\controller')
		;
	}

	function testHttpResponseIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance($output)
			)
			->then
				->object($this->testedInstance->httpResponseIs($response))
					->isEqualTo($this->newTestedInstance($output))
				->mock($response)
					->receive('outputIs')
						->withIdenticalArguments($output)
							->once
		;
	}
}
