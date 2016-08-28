<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
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
				$route = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance($routeAggregator, $route)
			)
			->then
				->mock($routeAggregator)
					->receive('recipientOfRouteAggregatorWithRouteIs')
						->withIdenticalArguments($route, $this->testedInstance)
							->once

			->given(
				$routeAggregator = new mockOfHttp\route\aggregator,
				$hashKey = new risingsun\hash\key(uniqid())
			)
			->if(
				$this->calling($route)->recipientOfHashKeyIs = function($hashKeyRecipient) use ($hashKey) {
					$hashKeyRecipient->httpRouteHasKey($hashKey);
				},
				$this->newTestedInstance($routeAggregator, $route)
			)
			->then
				->mock($routeAggregator)
					->receive('recipientOfRouteAggregatorWithRouteIs')
						->never
		;
	}

	function testHttpRouteControllerHasRequest()
	{
		$this
			->given(
				$routeAggregator = new mockOfHttp\route\aggregator,
				$controller = new mockOfHttp\route\controller,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance($routeAggregator)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeAggregator))
				->mock($routeAggregator)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $request)
							->once

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

				$hashKey = new risingsun\hash\key(uniqid()),
				$this->calling($route)->recipientOfHashKeyIs = function($hashKeyRecipient) use ($hashKey) {
					$hashKeyRecipient->httpRouteHasKey($hashKey);
				},
				$this->calling($request)->recipientOfHashKeyIs = function($hashKeyRecipient) use ($hashKey) {
					$hashKeyRecipient->httpRequestHasKey($hashKey);
				},
				$this->newTestedInstance($routeAggregator, $route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeAggregator, $route))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once
		;
	}

	function testRecipientOfHashKeyIs()
	{
		$this
			->given(
				$routeAggregator = new mockOfHttp\route\aggregator,
				$recipient = new mockOfHttp\route\hash\key\recipient
			)
			->if(
				$this->newTestedInstance($routeAggregator)
			)
			->then
				->object($this->testedInstance->recipientOfHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($routeAggregator))
		;
	}

	function testHttpRouteAggregatorIs()
	{
		$this
			->given(
				$aggregator = new mockOfHttp\route\aggregator,
				$otherAggregator = new mockOfHttp\route\aggregator,
				$otherAggregator->id = uniqid()
			)
			->if(
				$this->newTestedInstance($aggregator)
			)
			->then
				->object($this->testedInstance->httpRouteAggregatorIs($otherAggregator))
					->isEqualTo($this->newTestedInstance($aggregator))
		;
	}
}
