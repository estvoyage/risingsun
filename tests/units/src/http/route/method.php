<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\http,
	estvoyage\risingsun\ostring,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class method extends units\test
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
				$route = new mockOfHttp\route,
				$method = new mockOfHttp\method
			)
			->if(
				$this->calling($request)->recipientOfHttpMethodIs = function($recipient) use ($method) {
					$recipient->httpMethodIs($method);
				},

				$this->calling($method)->ifIsEqualToHttpMethod = function($method, $block) {
					$block->blockArgumentsAre();
				},

				$this->newTestedInstance($method, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($method, $route))
				->mock($route)
					->receive('recipientOfHttpResponseForRequestIs')
						->withIdenticalArguments($request, $recipient)
							->once
		;
	}

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$route = new mockOfHttp\route,
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance($method, $route)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $route))
		;
	}
}
