<?php namespace estvoyage\risingsun\tests\units\http\request;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\ostring,
	estvoyage\risingsun\oboolean,
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

	function testRecipientOfHttpUrlPathIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$path = new http\url\path(new ostring\notEmpty('/')),
				$recipient = new mockOfHttp\url\path\recipient
			)
			->if(
				$this->newTestedInstance($method, $path)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($path)
							->once
		;
	}

	function testRecipientOfHttpMethodIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$path = new http\url\path(new ostring\notEmpty('/')),
				$recipient = new mockOfHttp\method\recipient
			)
			->if(
				$this->newTestedInstance($method, $path)
			)
			->then
				->object($this->testedInstance->recipientOfHttpMethodIs($recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpMethodIs')
						->withArguments($method)
							->once
		;
	}

	function testRecipientOfSubRequestOfHttpUrlPathIs()
	{
		$this
			->given(
				$method = new mockOfHttp\method,
				$path = new mockOfHttp\url\path,
				$recipient = new mockOfHttp\request\recipient,
				$headPath = new http\url\path(new ostring\notEmpty('/'))
			)
			->if(
				$this->newTestedInstance($method, $path)
			)
			->then
				->object($this->testedInstance->recipientOfSubRequestOfHttpUrlPathIs($headPath, $recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpRequestIs')
						->never

			->given(
				$subRequestPath = new mockOfHttp\url\path
			)
			->if(
				$this->calling($path)->recipientOfHttpUrlPathWithoutHeadIs = function($aPath, $aRecipient) use ($headPath, $subRequestPath) {
					oboolean::isIdentical($aPath, $headPath)
						->ifTrue(
							new block\functor(
								function() use ($aRecipient, $subRequestPath)
								{
									$aRecipient->httpUrlPathIs($subRequestPath);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfSubRequestOfHttpUrlPathIs($headPath, $recipient))
					->isEqualTo($this->newTestedInstance($method, $path))
				->mock($recipient)
					->receive('httpRequestIs')
						->withArguments($this->newTestedInstance($method, $subRequestPath))
							->once
		;
	}
}
