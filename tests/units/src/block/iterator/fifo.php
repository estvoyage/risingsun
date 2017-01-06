<?php namespace estvoyage\risingsun\tests\units\block\iterator;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class fifo extends units\test
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
				$collection = new mockOfBlock\collection,
				$argument1 = uniqid(),
				$argument2 = uniqid()
			)
			->if(
				$this->newTestedInstance($collection)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($argument1, $argument2))
					->isEqualTo($this->newTestedInstance($collection))
				->mock($collection)
					->receive('payloadForIteratorIs')
						->withArguments(new block\collection\iterator\fifo, new block\collection\payload\arguments($argument1, $argument2))
							->once
		;
	}
}
