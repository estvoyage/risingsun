<?php namespace estvoyage\risingsun\tests\units\http\route\hash;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\ostring,
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
				$path = new http\url\path(new ostring\notEmpty('/foo')),
				$recipient = new mockOfHttp\route\hash\route\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteWithPathIs($path, $recipient))
					->isEqualTo($this->newTestedInstance)

			->given(
				$route = new mockOfHttp\route,

				$this->calling($route)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
				}
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteWithPathIs($path, $recipient))
					->isEqualTo($this->newTestedInstance($route))
				->mock($recipient)
					->receive('httpRouteWithPathIs')
						->withIdenticalArguments($route)
							->once
		;
	}

	function testRecipientOfHttpRouteHashWithRouteIs()
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
				$path = new http\url\path(new ostring\notEmpty('/foo')),

				$this->calling($route)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
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

	function testRecipientOfHttpResponseForRequestIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\response\recipient,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance)

			->given(
				$path = new http\url\path(new ostring\notEmpty('/foo')),

				$this->calling($request)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
				},

				$route = new mockOfHttp\route,
				$this->calling($route)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
				}
			)
			->if(
				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($route))
				->mock($route)
					->receive('recipientOfHttpResponseForRequestIs')
						->withArguments($request, $recipient)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
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
