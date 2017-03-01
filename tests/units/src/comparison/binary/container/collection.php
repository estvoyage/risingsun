<?php namespace estvoyage\risingsun\tests\units\comparison\binary\container;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison\binary as mockOfComparison, container as mockOfContainer };

class collection extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary\container')
		;
	}

	function testControllerOfPayloadForBinaryComparisonContainerIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfComparison\container\iterator,
				$payload = new mockOfComparison\container\payload,
				$controller = new mockOfContainer\iterator\controller,
				$comparison1 = new mockOfComparison,
				$comparison2 = new mockOfComparison,
				$comparison3 = new mockOfComparison
			)
			->if(
				$this->newTestedInstance($comparison1, $comparison2, $comparison3)
			)
			->then
				->object($this->testedInstance->controllerOfPayloadForBinaryComparisonContainerIteratorIs($payload, $iterator, $controller))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2, $comparison3))
				->mock($iterator)
					->receive('binaryComparisonsForPayloadWithControllerAre')
						->withArguments($payload, $controller, $comparison1, $comparison2, $comparison3)
							->once
		;
	}
}
