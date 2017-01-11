<?php namespace estvoyage\risingsun\tests\units\time\second\micro\recipient;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, time as mockOfTime };

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\second\micro\recipient')
		;
	}

	function testNumberOfMicroSecondIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$micro = new mockOfTime\second\micro
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->numberOfMicroSecondIs($micro))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($micro)
							->once
		;
	}
}
