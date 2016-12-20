<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\block,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class runner extends units\test
{
	function testBlockCollectionIs()
	{
$this
	->given(
		$output = new mockOfOutput,
		$block1 = new mockOfBlock,
		$block2 = new mockOfBlock
	)
	->if(
		$this->newTestedInstance($output)
	)
	->then
		->object($this->testedInstance->blockCollectionIs(new block\collection($block1, $block2)))
			->isEqualTo($this->newTestedInstance($output))
		->mock($block1)
			->receive('blockArgumentsAre')
				->withArguments($output)
					->once
		->mock($block2)
			->receive('blockArgumentsAre')
				->withArguments($output)
					->once
;
	}
}
