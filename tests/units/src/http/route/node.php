<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\iterator as mockOfIterator
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
				$iterator = new mockOfIterator,
				$firstRoute = new mockOfHttp\route,
				$secondRoute = new mockOfHttp\route
			)

			->given(
				$this->calling($iterator)->iteratorPayloadForValuesIs = function($values, $payload) use ($iterator, $firstRoute, $secondRoute) {
					$payload->currentValueOfIteratorIs($iterator, $firstRoute);
				},

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
				$this->newTestedInstance($iterator, $firstRoute, $secondRoute)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($iterator, $firstRoute, $secondRoute))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($firstResponse)
							->once
						->withIdenticalArguments($secondResponse)
							->never
				->mock($iterator)
					->receive('nextIteratorValuesAreUseless')
						->once
		;
	}
}
