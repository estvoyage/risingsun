<?php namespace estvoyage\risingsun\tests\units\http\request;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\ostring,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class v1_1 extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\request')
		;
	}

	function testRecipientOfHashKeyIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$path = new http\url\path(new ostring\notEmpty('/')),
				$recipient = new mockOfHttp\request\hash\key\recipient
			)
			->if(
				$this->newTestedInstance($method, $path)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRequestHashKeyIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpRequestHasKey')
						->withArguments(new hash\key($path))
							->once
		;
	}

	function testRecipientOfHttpRequestUrlPathIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$path = new http\url\path(new ostring\notEmpty('/')),
				$recipient = new mockOfHttp\request\url\path\recipient
			)
			->if(
				$this->newTestedInstance($method, $path)
			)
			->then
				->object($this->testedInstance->recipientOfHttpRequestUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpRequestUrlPathIs')
						->withIdenticalArguments($path)
							->once
		;
	}
}
