<?php namespace estvoyage\risingsun\tests\units\container;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\container as mockOfContainer;

class collection extends units\test
{
	function testPayloadForContainerIteratorIs()
	{
		$this
			->given(
				$payload = new mockOfContainer\payload,
				$iterator = new mockOfContainer\iterator
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->payloadForContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance)
				->mock($iterator)
					->receive('payloadForContainerValuesIs')
						->withArguments([], $payload)
							->once

			->given(
				$firstValue = uniqid(),
				$secondValue = uniqid()
			)
			->if(
				$this->newTestedInstance($firstValue, $secondValue)
			)
			->then
				->object($this->testedInstance->payloadForContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($firstValue, $secondValue))
				->mock($iterator)
					->receive('payloadForContainerValuesIs')
						->withArguments([ $firstValue, $secondValue ], $payload)
							->once
		;
	}
}
