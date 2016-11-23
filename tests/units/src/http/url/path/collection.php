<?php namespace estvoyage\risingsun\tests\units\http\url\path;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http\url as mockOfUrl,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class collection extends units\test
{
	function testRecipientOfHttpUrlPathIteratorWithPathIs()
	{
		$this
			->given(
				$recipient = new mockOfUrl\path\collection\recipient,
				$path = new mockOfUrl\path
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathCollectionWithPathIs($path, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('httpUrlPathCollectionIs')
						->withArguments($this->newTestedInstance($path))
							->once
		;
	}

	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$firstPath = new mockOfUrl\path,
				$firstPath->id = uniqid(),
				$secondPath = new mockOfUrl\path,
				$secondPath->id = uniqid(),
				$iterator = new mockOfIterator,
				$payload = new mockOfIterator\payload
			)
			->if(
				$this->newTestedInstance($firstPath, $secondPath)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($firstPath, $secondPath))
				->mock($iterator)
					->receive('iteratorPayloadForValuesIs')
						->withArguments([ $firstPath, $secondPath ], $payload)
							->once
		;
	}
}
