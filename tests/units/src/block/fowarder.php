<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class fowarder extends units\test
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
				$block = new mockOfBlock,
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance($value, $block)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($value, $block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($value)
							->once
		;
	}
}
