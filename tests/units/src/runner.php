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
	function testBlockIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($output)
			)
			->then
				->object($this->testedInstance->blockIs($block))
					->isEqualTo($this->newTestedInstance($output))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($output)
							->once
		;
	}
}
