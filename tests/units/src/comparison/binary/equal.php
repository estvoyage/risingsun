<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
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
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole));
	}

	function testReferenceForComparisonWithOperandIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$this->newTestedInstance($ok, $ko)
			)
			->if(
				$operand = uniqid(),
				$reference = uniqid()
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$operand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$reference = (string) $operand
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$operand = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$reference = $operand
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->twice
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
