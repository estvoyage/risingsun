<?php namespace estvoyage\risingsun\tests\units\block\output;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, output };
use mock\estvoyage\risingsun\{ ostring as mockOfOString, output as mockOfOutput };

class line extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$ostring = new mockOfOString
			)
			->if(
				$this->newTestedInstance($ostring)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ostring, new output\stdout))
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$ostring = new mockOfOString,
				$output = new mockOfOutput
			)
			->if(
				$this->newTestedInstance($ostring, $output)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($ostring, $output))
				->mock($output)
					->receive('outputLineIs')
						->withArguments($ostring)
							->once
		;
	}
}
