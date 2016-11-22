<?php namespace estvoyage\risingsun\tests\units\http\route\hash;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\hash,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\http\route\hash as mockOfHash
;

class map extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route\hash')
		;
	}

	function testRecipientOfHttpRouteAtKeyIs()
	{
		$this
			->given(
				$key = new hash\key(uniqid()),
				$recipient = new mockOfHttp\route\hash\route\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteAtKeyIs($key, $recipient))
					->isEqualTo($this->newTestedInstance)

			->given(
				$route = new mockOfHttp\route,

				$this->calling($route)->recipientOfHttpRouteHashKeyIs = function($recipient) use ($key) {
					$recipient->httpRouteHasKey($key);
				}
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteAtKeyIs($key, $recipient))
					->isEqualTo($this->newTestedInstance($route))
				->mock($recipient)
					->receive('hashKeyHasHttpRoute')
						->withIdenticalArguments($route)
							->once
		;
	}

	function testRecipientOfHttpRouteHasWithRouteIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\route\hash\recipient,
				$route = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteHashWithRouteIs($route, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('httpRouteHashIs')
						->never

			->given(
				$key = new hash\key(uniqid()),

				$this->calling($route)->recipientOfHttpRouteHashKeyIs = function($recipient) use ($key) {
					$recipient->httpRouteHasKey($key);
				}
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteHashWithRouteIs($route, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('httpRouteHashIs')
						->withArguments($this->newTestedInstance($route))
							->once
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
				$key = new hash\key(uniqid()),

				$this->calling($request)->recipientOfHttpRequestHashKeyIs = function($recipient) use ($key) {
					$recipient->httpRequestHasKey($key);
				},

				$route = new mockOfHttp\route,
				$this->calling($route)->recipientOfHttpRouteHashKeyIs = function($recipient) use ($key) {
					$recipient->httpRouteHasKey($key);
				}
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($route))
				->mock($route)
					->receive('httpRouteControllerHasRequest')
						->withArguments($controller, $request)
							->once
		;
	}

	function testRecipientOfHttpRouteHashKeyIs()
	{
		$this
			->given(
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\route\hash\key\recipient
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($route))
		;
	}
}
