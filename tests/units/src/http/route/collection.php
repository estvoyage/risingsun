<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class collection extends units\test
{
	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$firstRoute = new mockOfHttp\route,
				$firstRoute->id = uniqid(),
				$secondRoute = new mockOfHttp\route,
				$secondRoute->id = uniqid(),
				$iterator = new mockOfIterator,
				$payload = new mockOfIterator\payload
			)
			->if(
				$this->newTestedInstance($firstRoute, $secondRoute)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($firstRoute, $secondRoute))
				->mock($iterator)
					->receive('iteratorPayloadForValuesIs')
						->withArguments([ $firstRoute, $secondRoute ], $payload)
							->once
		;
	}

}
