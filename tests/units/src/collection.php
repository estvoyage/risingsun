<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun as mockOfRisingsun
;

class collection extends units\test
{
	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfRisingsun\iterator,
				$payload = new mockOfRisingsun\iterator\payload
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance)

			->given(
				$values = [ 0, 1 ]
			)
			->if(
				$this->newTestedInstance(... $values)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance(... $values))
				->mock($iterator)
					->receive('iteratorPayloadForValuesIs')
						->withArguments($values, $payload)
							->once
		;
	}

	function testRecipientOfCollectionWithValueIs()
	{
		$this
			->given(
				$recipient = new mockOfRisingsun\collection\recipient,
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfCollectionWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('collectionIs')
						->withArguments($this->newTestedInstance($value))
							->once
		;
	}
}
