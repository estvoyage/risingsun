<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block, http };
use mock\estvoyage\risingsun\http as mockOfHttp;

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
				$iterator = new mockOfHttp\route\collection\iterator,
				$collection = new mockOfHttp\route\collection
			)
			->if(
				$this->newTestedInstance($iterator, $collection)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($iterator, $collection))
				->mock($collection)
					->receive('payloadForIteratorIs')
						->withArguments($iterator, new http\route\collection\payload\requestFromRecipient($request, $recipient))
							->once
		;
	}
}
