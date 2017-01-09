<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{tests\units, block};
use mock\estvoyage\risingsun\{block as mockOfBlock, iterator as mockOfIterator};

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
				$iterator = new mockOfBlock\collection\iterator,
				$collection = new mockOfBlock\collection,
				$argument1 = uniqid(),
				$argument2 = uniqid()
			)
			->if(
				$this->newTestedInstance($iterator, $collection)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($argument1, $argument2))
					->isEqualTo($this->newTestedInstance($iterator, $collection))
				->mock($collection)
					->receive('payloadForIteratorIs')
						->withArguments($iterator, new block\collection\payload\arguments($argument1, $argument2))
							->once
		;
	}
}
