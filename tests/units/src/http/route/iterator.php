<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class iterator extends units\test
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
				$iterator = new mockOfIterator,
				$firstRoute = new mockOfHttp\route,
				$secondRoute = new mockOfHttp\route
			)

			->given(
				$this->calling($iterator)->iteratorPayloadForValuesIs = function($values, $payload) use ($iterator, $firstRoute, $secondRoute) {
					$payload->currentValueOfIteratorIs($iterator, $firstRoute);
				},

				$firstResponse = new mockOfHttp\response,

				$this->calling($firstRoute)->recipientOfHttpResponseForRequestIs = function($aRequest, $aRecipient) use ($request, $firstResponse) {
					oboolean::isIdentical($request, $aRequest)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $firstResponse) {
									$aRecipient->httpResponseIs($firstResponse);
								}
							)
						)
					;
				},

				$secondResponse = new mockOfHttp\response,

				$this->calling($secondRoute)->recipientOfHttpResponseForRequestIs = function($aRecipient, $aRequest) use ($request, $secondResponse) {
					oboolean::isIdentical($request, $aRequest)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $secondResponse) {
									$aRecipient->httpResponseIs($secondResponse);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($iterator, $firstRoute, $secondRoute)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($iterator, $firstRoute, $secondRoute))
				->mock($recipient)
					->receive('httpResponseIs')
						->withIdenticalArguments($firstResponse)
							->once
						->withIdenticalArguments($secondResponse)
							->never
				->mock($iterator)
					->receive('nextIteratorValuesAreUseless')
						->once
		;
	}
}
