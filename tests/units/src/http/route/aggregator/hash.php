<?php namespace estvoyage\risingsun\tests\units\http\route\aggregator;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\hash as mockOfHash,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class hash extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$routeAggregator = new mockOfHttp\route\aggregator,
				$routeHash = new mockOfHttp\route\hash,
				$route = new mockOfHttp\route
			)

			->if(
				$this->newTestedInstance($routeAggregator, $routeHash)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($routeAggregator, $routeHash))

			->given(
				$routeAggregatorWithRoute = new mockOfHttp\route\aggregator,

				$this->calling($routeAggregator)->recipientOfRouteAggregatorWithRouteIs = function($aRoute, $aRecipient) use ($route, $routeAggregatorWithRoute) {
					risingsun\oboolean::isIdentical($route, $aRoute)
						->ifTrue(new block\functor(function() use ($aRoute, $aRecipient, $routeAggregatorWithRoute) {
									$routeAggregatorWithRoute->route = $aRoute;

									$aRecipient->httpRouteAggregatorIs($routeAggregatorWithRoute);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($routeAggregator, $routeHash, $route)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($routeAggregatorWithRoute, $routeHash))

			->given(
				$routeHashWithRoute = new mockOfHttp\route\hash,

				$this->calling($routeHash)->recipientOfHttpRouteHashWithRouteIs = function($aRoute, $recipient) use ($route, $routeHashWithRoute) {
					risingsun\oboolean::isEqual($aRoute, $route)
						->ifTrue(new block\functor(function() use ($aRoute, $recipient, $routeHashWithRoute) {
									$routeHashWithRoute->route = $aRoute;

									$recipient->httpRouteHashIs($routeHashWithRoute);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($routeAggregator, $routeHash, $route)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($routeAggregator, $routeHashWithRoute))
		;
	}

	function testHttpRouteControllerHasRequest()
	{
		$this
			->given(
				$routeAggregator = new mockOfHttp\route\aggregator,
				$routeHash = new mockOfHttp\route\hash,
				$controller = new mockOfHttp\route\controller,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance($routeAggregator, $routeHash)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeAggregator, $routeHash))
				->mock($routeAggregator)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $request)
							->once

			->given(
				$route = new mockOfHttp\route,
				$response = new mockOfHttp\response
			)
			->if(
				$this->calling($routeHash)->httpRouteControllerHasRequest = function($aController, $aRequest) use ($request, $response) {
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

				$this->newTestedInstance($routeAggregator, $routeHash, $route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeAggregator, $routeHash, $route))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once
				->mock($routeAggregator)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $request)
							->once
		;
	}
}