<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class fifo extends units\test
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
				$this->calling($route)->httpRouteControllerHasRequest = function($aController, $aRequest) use ($request, $response) {
					oboolean::isEqual($aRequest, $request)
						->ifTrue(
							new block\functor(
								function() use ($aController, $response) {
									$aController->httpResponseIs($response);
								}
							)
						)
					;
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

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
