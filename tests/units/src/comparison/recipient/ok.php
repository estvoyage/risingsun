<?php namespace estvoyage\risingsun\tests\units\comparison\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class ok extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testNBooleanIs()
	{
		$this
			->given(
				$this->newTestedInstance($block = new mockOfBlock)
			)
			->if(
				$this->testedInstance->nbooleanIs(false)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->testedInstance->nbooleanIs(true)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
