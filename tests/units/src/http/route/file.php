<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\oboolean,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class file extends units\test
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
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\response\recipient,
				$request = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($route)
					->receive('recipientOfHttpResponseForRequestIs')
						->never

			->given(
				$this->calling($request)->recipientOfHttpUrlPathIs = function($recipient) use ($path) {
					$recipient->httpUrlPathIs($path);
				},
				$this->calling($path)->ifIsEqualToHttpUrlPath = function($aPath, $aBlock) use ($path) {
					oboolean::isIdentical($aPath, $path)
						->ifTrue($aBlock)
					;
				}
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($route)
					->receive('recipientOfHttpResponseForRequestIs')
						->withIdenticalArguments($request, $recipient)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		$this
			->given(
				$path = new mockOfHttp\url\path,
				$route = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance($path, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($path, $route))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withIdenticalArguments($path)
							->once
		;
	}
}
