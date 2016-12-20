<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class stream extends units\test
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
				$stream = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance($stream)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($stream))
				->mock($recipient)
					->receive('httpResponseIs')
						->withArguments(new http\response\stream($stream))
							->once
		;
	}
}
