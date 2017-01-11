<?php namespace estvoyage\risingsun\tests\units\output\stream\collection\iterator;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ output, tests\units };
use mock\estvoyage\risingsun\{ iterator as mockOfIterator, output as mockOfOutput };

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\collection\iterator')
		;
	}

	function testStreamsForPayloadAre()
	{
		$this
			->given(
				$iterator = new mockOfIterator,
				$payload = new mockOfOutput\stream\collection\payload,
				$stream1 = new mockOfOutput\stream,
				$stream2 = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance($iterator)
			)
			->then
				->object($this->testedInstance->streamsForPayloadAre($payload, $stream1, $stream2))
					->isEqualTo($this->newTestedInstance($iterator))
				->mock($iterator)
					->receive('iteratorPayloadForValuesIs')
						->withArguments([ $stream1, $stream2 ], new output\stream\collection\payload\iterator($payload))
							->once
		;
	}
}
