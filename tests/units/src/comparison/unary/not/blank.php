<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class blank extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

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

	function testOperandForComparison()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$this->newTestedInstance($ok, $ko)
			)
			->if(
				$operand = uniqid()
			)
			->then
				->object($this->testedInstance->operandForComparisonIs($operand))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->if(
				$operand = ''
			)
			->then
				->object($this->testedInstance->operandForComparisonIs($operand))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
