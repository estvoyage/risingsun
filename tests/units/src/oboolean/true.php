<?php namespace estvoyage\risingsun\tests\units\oboolean;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun as mockOfRisingsun
;

class true extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\oboolean')
		;
	}

	function testIfTrue()
	{
		$this
			->given(
				$block = new mockOfRisingsun\block
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifTrue($block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfFalse()
	{
		$this
			->given(
				$block = new mockOfRisingsun\block
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifFalse($block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never
		;
	}
}
