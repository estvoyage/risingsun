<?php namespace estvoyage\risingsun\tests\units\block\collection\payload;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class arguments extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block\collection\payload')
		;
	}

	function testCurrentBlockOfIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfIterator,
				$block = new mockOfBlock,
				$argument1 = uniqid(),
				$argument2 = uniqid()
			)
			->if(
				$this->newTestedInstance($argument1, $argument2)
			)
			->then
				->object($this->testedInstance->currentBlockOfIteratorIs($iterator, $block))
					->isEqualTo($this->newTestedInstance($argument1, $argument2))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($argument1, $argument2)
							->once
		;
	}
}
