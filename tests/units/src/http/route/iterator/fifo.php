<?php namespace estvoyage\risingsun\tests\units\http\route\iterator;

require __DIR__ . '/../../../../runner.php';

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
				$request = new mockOfHttp\request,
				$route1 = new mockOfHttp\route,
				$route2 = new mockOfHttp\route,
				$response = new mockOfHttp\response
			)
			->if(
				$this->calling($route1)->recipientOfHttpResponseForRequestIs = function($aRequest, $aRecipient) use ($request, $response) {
					oboolean::isIdentical($aRequest, $request)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $response)
								{
									$aRecipient->httpResponseIs($response);
								}
							)
						)
					;
				},
				$this->newTestedInstance($route1, $route2)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($route1, $route2))
				->mock($recipient)
					->receive('httpResponseIs')
						->withArguments($response)
							->once
				->mock($route2)
					->receive('recipientOfHttpResponseForRequestIs')
						->never
		;
	}
}
