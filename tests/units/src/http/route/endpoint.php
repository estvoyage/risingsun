<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class endpoint extends units\test
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
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance($response)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($response))
				->mock($recipient)
					->receive('httpResponseIs')
						->withIdenticalArguments($response)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\url\path\recipient,
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance($response)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($response))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->never
		;
	}
}
