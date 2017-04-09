<?php namespace estvoyage\risingsun\tests\units\comparison\unary\switcher;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class boolean extends units\test
{
	function testBooleanForValueIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$this->newTestedInstance($ok, $ko)
			)
			->if(
				$value = uniqid(),
				$boolean = true
			)
			->then
				->object($this->testedInstance->booleanForValueIs($value, $boolean))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->withArguments($value)
							->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never
		;
	}
}
