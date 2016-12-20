<?php namespace estvoyage\risingsun\tests\units\http\route\file;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\oboolean,
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
				$path = new mockOfHttp\url\path,
				$recipient = new mockOfHttp\response\recipient,
				$request = new mockOfHttp\request,
				$stream = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance($path, $stream)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $stream))
				->mock($recipient)
					->receive('httpResponseIs')
						->never

			->given(
				$this->calling($request)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
				},

				$this->calling($path)->ifIsEqualToHttpUrlPath = function($aPath, $aBlock) use ($path) {
					oboolean::isIdentical($path, $aPath)->ifTrue($aBlock);
				}
			)
			->if(
				$this->newTestedInstance($path, $stream)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $stream))
				->mock($recipient)
					->receive('httpResponseIs')
						->withArguments(new http\response\stream($stream))
							->once
		;
	}
}
