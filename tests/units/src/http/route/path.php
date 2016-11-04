<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class path extends units\test
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
				$endpoint = new mockOfHttp\route\endpoint,
				$request = new mockOfHttp\request,
				$path = new http\url\path\root
			)
			->if(
				$this->newTestedInstance($path, $endpoint)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($path, $endpoint))
				->mock($controller)
					->receive('httpResponseIs')
						->never

			->given(
				$requestPath = new http\url\path\root,
				$response = new mockOfHttp\response
			)
			->if(
				$this->calling($request)->recipientOfHttpRequestUrlPathIs = function($recipient) use ($requestPath) {
					$recipient->httpRequestUrlPathIs($requestPath);
				},
				$this->calling($endpoint)->recipientOfHttpResponseForRequestIs = function($endpointRequest, $recipient) use ($request, $response) {
					oboolean::isIdentical(
						$request,
						$endpointRequest
					)
						->ifTrue(
							new block\functor(
								function() use ($recipient, $response) {
									$recipient->httpResponseIs($response);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($path, $endpoint))
				->mock($controller)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once
		;
	}

	function testRecipientOfHttpRouteHashKeyIs()
	{
		$this
			->given(
				$path = new http\url\path\root,
				$endpoint = new mockOfHttp\route\endpoint,
				$recipient = new mockOfHttp\route\hash\key\recipient
			)
			->if(
				$this->newTestedInstance($path, $endpoint)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRouteHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($path, $endpoint))
		;
	}
}
