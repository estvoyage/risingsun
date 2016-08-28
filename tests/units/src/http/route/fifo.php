<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\hash as mockOfHash
;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route')
			->implements('estvoyage\risingsun\http\route\controller')
		;
	}

	function testHttpRouteControllerHasRequest()
	{
		$this
			->given(
				$controller = new mockOfHttp\route\controller,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance)

			->given(
				$route = new mockOfHttp\route,
				$response = new mockOfHttp\response
			)
			->if(
				$this->calling($route)->httpRouteControllerHasRequest = function($routeController, $routeRequest) use ($request, $response) {
					if ($routeRequest === $request)
					{
						$routeController->httpResponseIs($response);
					}
				},
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($route))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once

			->given(
				$otherRoute = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance($route, $otherRoute)
					->httpRouteControllerHasRequest($controller, $request)
			)
			->then
				->mock($otherRoute)
					->receive('httpRouteControllerHasRequest')
						->never
		;
	}

	function testRecipientOfHashKeyIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\route\hash\key\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance)
		;
	}

	function testHttpResponseIs()
	{
		$this
			->given(
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->httpResponseIs($response))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
