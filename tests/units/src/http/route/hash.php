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
			->implements('estvoyage\risingsun\hash\key\recipient')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$routeIterator = new mockOfHttp\route\iterator,
				$route = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance($routeIterator, $route)
			)
			->then
				->mock($routeIterator)
					->receive('recipientOfRouteIteratorWithRouteIs')
						->withIdenticalArguments($route, $this->testedInstance)
							->once

			->given(
				$routeIterator = new mockOfHttp\route\iterator,
				$hashKey = new risingsun\hash\key(uniqid())
			)
			->if(
				$this->calling($route)->recipientOfHashKeyIs = function($hashKeyRecipient) use ($hashKey) {
					$hashKeyRecipient->hashKeyIs($hashKey);
				},
				$this->newTestedInstance($routeIterator, $route)
			)
			->then
				->mock($routeIterator)
					->receive('recipientOfRouteIteratorWithRouteIs')
						->never
		;
	}

	function testHttpRouteControllerHasRequest()
	{
		$this
			->given(
				$routeIterator = new mockOfHttp\route\iterator,
				$controller = new mockOfHttp\route\controller,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance($routeIterator)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeIterator))
				->mock($routeIterator)
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
					$hashKeyRecipient->hashKeyIs($hashKey);
				},
				$this->calling($request)->recipientOfHashKeyIs = function($hashKeyRecipient) use ($hashKey) {
					$hashKeyRecipient->hashKeyIs($hashKey);
				},
				$this->newTestedInstance($routeIterator, $route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($routeIterator, $route))
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
				$routeIterator = new mockOfHttp\route\iterator,
				$recipient = new mockOfHash\key\recipient
			)
			->if(
				$this->newTestedInstance($routeIterator)
			)
			->then
				->object($this->testedInstance->recipientOfHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($routeIterator))
		;
	}

	function testHashKeyIs()
	{
		$this
			->given(
				$key = new risingsun\hash\key(uniqid())
			)
			->if(
				$this->newTestedInstance(new mockOfHttp\route\iterator)
			)
			->then
				->object($this->testedInstance->hashKeyIs($key))
					->isEqualTo($this->newTestedInstance(new mockOfHttp\route\iterator))
		;
	}

	function testHttpRouteIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfHttp\route\iterator,
				$otherIterator = new mockOfHttp\route\iterator,
				$otherIterator->id = uniqid()
			)
			->if(
				$this->newTestedInstance($iterator)
			)
			->then
				->object($this->testedInstance->httpRouteIteratorIs($otherIterator))
					->isEqualTo($this->newTestedInstance($iterator))
		;
	}
}
