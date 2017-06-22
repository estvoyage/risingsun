<?php namespace estvoyage\risingsun\tests\units\comparison\unary\container;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison\unary as mockOfComparison;

class collection extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary\container')
		;
	}

	function testPayloadForUnaryComparisonContainerIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfComparison\container\iterator,
				$payload = new mockOfComparison\container\payload,
				$comparison1 = new mockOfComparison,
				$comparison2 = new mockOfComparison
			)
			->if(
				$this->newTestedInstance($comparison1, $comparison2)->payloadForUnaryComparisonContainerIteratorIs($iterator, $payload)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($iterator)
					->receive('unaryComparisonsForPayloadAre')
						->withArguments($payload, $comparison1, $comparison2)
							->once
		;
	}
}
