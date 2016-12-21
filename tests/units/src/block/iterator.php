<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class iterator extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$iterator = new mockOfIterator,
				$this->calling($iterator)->iteratorPayloadForValuesIs = function($values, $payload) use ($iterator) {
					$payload->currentValueOfIteratorIs($iterator, $values[0]);
				},
				$block = new mockOfBlock,
				$collection = new mockOfBlock\collection,
				$this->calling($collection)->payloadForIteratorIs = function($iterator, $payload) use ($block) {
					$iterator->iteratorPayloadForValuesIs([ $block ], $payload);
				},
				$argument1 = uniqid(),
				$argument2 = uniqid()
			)
			->if(
				$this->newTestedInstance($iterator, $collection)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($argument1, $argument2))
					->isEqualTo($this->newTestedInstance($iterator, $collection))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($argument1, $argument2)
							->once
		;
	}
}
