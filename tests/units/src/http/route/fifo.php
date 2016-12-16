<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class fifo extends units\test
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
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance)

			->given(
				$route = new mockOfHttp\route,
				$response = new mockOfHttp\response
			)
			->if(
				$this->calling($route)->recipientOfHttpResponseForRequestIs = function($aRequest, $aRecipient) use ($request, $response) {
					oboolean::isEqual($aRequest, $request)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $response) {
									$aRecipient->httpResponseIs($response);
								}
							)
						)
					;
				},

				$this->newTestedInstance($route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($route))
				->mock($recipient)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once

			->given(
				$otherRoute = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance($route, $otherRoute)
					->recipientOfHttpResponseForRequestIs($request, $recipient)
			)
			->then
				->mock($otherRoute)
					->receive('recipientOfHttpResponseForRequestIs')
						->never
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
