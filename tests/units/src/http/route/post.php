<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class post extends units\test
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
				$method = new http\method\post
			)
			->if(
				$this->calling($request)->recipientOfHttpMethodIs = function($recipient) use ($method) {
					$recipient->httpMethodIs($method);
				},

				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($route))
				->mock($route)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $request)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($route))
		;
	}
}
