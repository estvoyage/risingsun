<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class collection extends units\test
{
	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$block1 = new mockOfBlock,
				$block2 = new mockOfBlock,
				$iterator = new mockOfBlock\collection\iterator,
				$payload = new mockOfBlock\collection\payload
			)
			->if(
				$this->newTestedInstance($block1, $block2)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($block1, $block2))
				->mock($iterator)
					->receive('blocksForPayloadAre')
						->withArguments($payload, $block1, $block2)
							->once
		;
	}
}
