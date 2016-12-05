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
				$route = new mockOfHttp\route,
				$request = new mockOfHttp\request,
				$path = new http\url\path\root
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($controller)
					->receive('httpResponseIs')
						->never

			->given(
				$requestPath = new http\url\path\root,
				$response = new mockOfHttp\response,
				$subRequest = new mockOfHttp\request
			)
			->if(
				$this->calling($request)->recipientOfHttpUrlPathIs = function($recipient) use ($requestPath) {
					$recipient->httpUrlPathIs($requestPath);
				},
				$this->calling($request)->recipientOfHttpRequestWithoutHeadUrlPathIs = function($aPath, $aRecipient) use ($path, $subRequest) {
					oboolean::isIdentical($path, $aPath)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $subRequest) {
									$aRecipient->httpRequestIs($subRequest);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->httpRouteControllerHasRequest($controller, $request))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($route)
					->receive('httpRouteControllerHasRequest')
						->withIdenticalArguments($controller, $subRequest)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$path = new http\url\path\root,
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($path)
							->once
		;
	}
}
