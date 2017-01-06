<?php namespace estvoyage\risingsun\tests\units\block\collection\iterator;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block\collection\iterator')
		;
	}

	function testBlocksForPayloadAre()
	{
		$this
			->given(
				$payload = new mockOfBlock\collection\payload,
				$this->calling($payload)->currentBlockOfIteratorIs = function($anIterator, $aBlock) use (& $blocks) {
					$blocks[] = $aBlock;
				},
				$block1 = new mockOfBlock,
				$block2 = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->blocksForPayloadAre($payload, $block1, $block2))
					->isEqualTo($this->newTestedInstance)
				->array($blocks)
					->isEqualTo([ $block1, $block2 ])
		;
	}
}
