<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\ostring,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class method extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route')
		;
	}

	function testHttpRouteControllerHasRequest()
	{
		$this
			->given(
				$controller = new mockOfHttp\route\controller,
				$request = new mockOfHttp\request,
				$route = new mockOfHttp\route,
				$method = new mockOfHttp\method
			)
			->if(
				$this->calling($request)->recipientOfHttpMethodIs = function($recipient) use ($method) {
					$recipient->httpMethodIs($method);
				},

				$this->calling($method)->ifIsEqualToHttpMethod = function($method, $block) {
					$block->blockArgumentsAre();
				},

				$this->newTestedInstance($method, $route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($method, $route))
				->mock($route)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $request)
							->once
		;
	}

	function testRecipientOfHttpRouteHashKeyIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\route\hash\key\recipient
			)
			->if(
				$this->newTestedInstance($method, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $route))
		;
	}
}
