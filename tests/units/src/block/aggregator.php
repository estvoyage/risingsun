<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class aggregator extends units\test
{
	function test__construct()
	{
		$this
			->given(
				$ok = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole))
		;
	}

	function testBlockIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->blockIs($block))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($ok, $ko)
							->once
		;
	}
}
