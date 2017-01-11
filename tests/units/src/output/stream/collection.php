<?php namespace estvoyage\risingsun\tests\units\output\stream;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\output as mockOfOutput;

class collection extends units\test
{
	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfOutput\stream\collection\iterator,
				$payload = new mockOfOutput\stream\collection\payload,
				$stream1 = new mockOfOutput\stream,
				$stream2 = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance($stream1, $stream2)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($stream1, $stream2))
				->mock($iterator)
					->receive('streamsForPayloadAre')
						->withArguments($payload, $stream1, $stream2)
							->once
		;
	}
}
