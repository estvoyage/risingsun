<?php namespace estvoyage\risingsun\tests\units\comparison\binary\container;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison\binary as mockOfComparison;

class collection extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary\container')
		;
	}

	function testPayloadForBinaryComparisonContainerIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfComparison\container\iterator,
				$payload = new mockOfComparison\container\payload,
				$comparison = new mockOfComparison
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->payloadForBinaryComparisonContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($iterator)
					->receive('binaryComparisonsForPayloadAre')
						->withArguments($payload, $comparison)
							->once
		;
	}
}
