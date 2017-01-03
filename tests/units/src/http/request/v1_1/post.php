<?php namespace estvoyage\risingsun\tests\units\http\request\v1_1;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class post extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\request')
		;
	}

	function testRecipientOfHttpMethodIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\method\recipient,
				$path = new mockOfHttp\url\path
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->recipientOfHttpMethodIs($recipient))
					->isEqualTo($this->newTestedInstance($path))
		;
	}
}
