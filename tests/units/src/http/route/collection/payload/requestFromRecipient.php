<?php namespace estvoyage\risingsun\tests\units\http\route\collection\payload;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block };
use mock\estvoyage\risingsun\{ iterator as mockOfIterator, http as mockOfHttp };

class requestFromRecipient extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route\collection\payload')
		;
	}

	function testCurrentHttpRouteOfIteratorIs()
	{
		$this
			->given(
				$request = new mockOfHttp\request,

				$recipient = new mockOfHttp\response\recipient,

				$response = new mockOfHttp\response,

				$iterator = new mockOfIterator,

				$route = new mockOfHttp\route,
				$this->calling($route)->recipientOfHttpResponseForRequestIs = function($aRequest, $aRecipient) use ($request, $response) {
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
				}
			)
			->if(
				$this->newTestedInstance($request, $recipient)
			)
			->then
				->object($this->testedInstance->currentHttpRouteOfIteratorIs($iterator, $route))
					->isEqualTo($this->newTestedInstance($request, $recipient))
				->mock($recipient)
					->receive('httpResponseIs')
						->withArguments($response)
							->once
				->mock($iterator)
					->receive('nextIteratorValuesAreUseless')
						->once
		;
	}
}
