<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class directory extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route')
		;
	}

	function testRecipientOfHttpResponseForRequestIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\response\recipient,
				$route = new mockOfHttp\route,
				$request = new mockOfHttp\request,
				$path = new mockOfHttp\url\path
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($recipient)
					->receive('httpResponseIs')
						->never

			->given(
				$subRequest = new mockOfHttp\request
			)
			->if(
				$this->calling($request)->recipientOfSubRequestOfHttpUrlPathIs = function($aPath, $aRecipient) use ($path, $subRequest) {
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
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($route)
					->receive('recipientOfHttpResponseForRequestIs')
						->withIdenticalArguments($subRequest, $recipient)
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
