<?php namespace estvoyage\risingsun\tests\units\datum\container;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\datum as mockOfDatum;

class collection extends units\test
{
	function testPayloadForDatumContainerIteratorIs()
	{
		$this
			->given(
				$payload = new mockOfDatum\Container\payload,
				$iterator = new mockOfDatum\Container\iterator
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->payloadForDatumContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance)
				->mock($iterator)
					->receive('dataForPayloadAre')
						->withArguments($payload)
							->once

			->given(
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($firstDatum, $secondDatum)
			)
			->then
				->object($this->testedInstance->payloadForDatumContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($firstDatum, $secondDatum))
				->mock($iterator)
					->receive('dataForPayloadAre')
						->withArguments($payload, $firstDatum, $secondDatum)
							->once
		;
	}
}
