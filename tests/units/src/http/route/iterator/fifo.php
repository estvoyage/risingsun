<?php namespace estvoyage\risingsun\tests\units\http\route\iterator;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{tests\units, block, oboolean, http};
use mock\estvoyage\risingsun\http as mockOfHttp;

class fifo extends units\test
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
				$collection = new mockOfHttp\route\collection,
				$response = new mockOfHttp\response
			)
			->if(
				$this->newTestedInstance($collection)
			)
			->then
				->object($this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient))
					->isEqualTo($this->newTestedInstance($collection))
				->mock($collection)
					->receive('payloadForIteratorIs')
						->withArguments(new http\route\collection\iterator\fifo, new http\route\collection\payload\requestFromRecipient($request, $recipient))
							->once
		;
	}
}
