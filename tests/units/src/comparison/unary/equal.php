<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class equal extends units\test
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
				$reference = uniqid(),
				$ok = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($reference, $ok)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($reference, $ok, new block\blackhole))
		;
	}

	function testOperandForComparisonIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$reference = uniqid(),
				$this->newTestedInstance($reference, $ok, $ko)
			)
			->if(
				$operand = uniqid()
			)
			->then
				->object($this->testedInstance->operandForComparisonIs($operand))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$operand = $reference
			)
			->then
				->object($this->testedInstance->operandForComparisonIs($operand))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
