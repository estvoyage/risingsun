<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class greaterThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
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
				$operand = 0,
				$reference = 0
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
				$operand = 0,
				$reference = M_PI
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$operand = M_PI,
				$reference = 0
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice
		;
	}
}
