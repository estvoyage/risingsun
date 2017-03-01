<?php namespace estvoyage\risingsun\tests\units\comparison\container\iterator;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, ointeger as mockOfOInteger, container as mockOfContainer };

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\container\iterator')
		;
	}

	function testComparisonsForPayloadWithControllerAre()
	{
		$this
			->given(
				$payload = new mockOfComparison\container\payload,
				$controller = new mockOfContainer\iterator\controller,
				$comparison1 = new mockOfComparison\binary,
				$comparison2 = new mockOfComparison\binary,
				$comparison3 = new mockOfComparison\binary,
				$generator = new mockOfOInteger\generator
			)
			->if(
				$this->newTestedInstance($generator)
			)
			->then
				->object($this->testedInstance->comparisonsForPayloadWithControllerAre($payload, $controller, $comparison1, $comparison2, $comparison3))
					->isEqualTo($this->newTestedInstance($generator))
				->mock($payload)
					->receive('iteratorControllerForComparisonAtPositionIs')
						->never

			->given(
				$position1 = new mockOfOInteger,
				$position2 = new mockOfOInteger,
				$position3 = new mockOfOInteger,
				$comparisonsController = new mockOfContainer\iterator\controller
			)
			->if(
				$this->calling($generator)->recipientOfOIntegerIs[1] = function($recipient) use ($position1) {
					$recipient->ointegerIs($position1);
				},
				$this->calling($generator)->recipientOfOIntegerIs[2] = function($recipient) use ($position2) {
					$recipient->ointegerIs($position2);
				},
				$this->calling($generator)->recipientOfOIntegerIs[3] = function($recipient) use ($position3) {
					$recipient->ointegerIs($position3);
				},
				$this->calling($controller)->blockToStopContainerIteratorEngineIs = function($engine, $block) use ($comparisonsController, & $stopBlock) {
					$stopBlock = $block;

					$engine->controllerOfContainerIteratorIs($comparisonsController);
				}
			)
			->then
				->object($this->testedInstance->comparisonsForPayloadWithControllerAre($payload, $controller, $comparison1, $comparison2, $comparison3))
					->isEqualTo($this->newTestedInstance($generator))
				->mock($payload)
					->receive('iteratorControllerForComparisonAtPositionIs')
						->withIdenticalArguments($comparison1, $position1, $comparisonsController)
							->once
						->withIdenticalArguments($comparison2, $position2, $comparisonsController)
							->once
						->withIdenticalArguments($comparison3, $position3, $comparisonsController)
							->once
		;
	}
}
