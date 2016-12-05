<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class node extends units\test
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
				$firstRoute = new mockOfHttp\route,
				$secondRoute = new mockOfHttp\route
			)

			->given(
				$firstResponse = new mockOfHttp\response,
				$this->calling($firstRoute)->httpRouteControllerHasRequest = function($aController, $aRequest) use ($request, $firstResponse) {
					oboolean::isIdentical($request, $aRequest)
						->ifTrue(
							new block\functor(
								function() use ($aController, $firstResponse) {
									$aController->httpResponseIs($firstResponse);
								}
							)
						)
					;
				},
				$secondResponse = new mockOfHttp\response,
				$this->calling($secondRoute)->httpRouteControllerHasRequest = function($aController, $aRequest) use ($request, $secondResponse) {
					oboolean::isIdentical($request, $aRequest)
						->ifTrue(
							new block\functor(
								function() use ($aController, $secondResponse) {
									$aController->httpResponseIs($secondResponse);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($firstRoute, $secondRoute)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($firstRoute, $secondRoute))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($firstResponse)
							->once
						->withIdenticalArguments($secondResponse)
							->never

			->given(
				$this->calling($firstRoute)->httpRouteControllerHasRequest->doesNothing
			)
			->if(
				$this->newTestedInstance($firstRoute, $secondRoute)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($firstRoute, $secondRoute))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($firstResponse)
							->once
						->withIdenticalArguments($secondResponse)
							->once
		;
	}
}
