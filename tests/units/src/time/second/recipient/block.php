<?php namespace estvoyage\risingsun\tests\units\time\second\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ time as mockOfTime, block as mockOfBlock };

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\second\recipient')
		;
	}

	function testNumberOfSecondIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$second = new mockOfTime\second
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->numberOfSecondIs($second))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($second)
							->once
		;
	}
}
