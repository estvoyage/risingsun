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

	/**
	 * @dataProvider okProvider
	 */
	function testReferenceForComparisonWithOperandIs_withOkOperandForReference($operand, $reference)
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithOperandIs($operand, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider koProvider
	 */
	function testReferenceForComparisonWithOperandIs_withKoOperandForReference($operand, $reference)
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok, $ko)
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
		;
	}

	protected function okProvider()
	{
		return [
			[ 'foo', 'foo' ],
			[ 0, 0, ],
			[ 0., 0, ],
			[ 0, 0., ],
			[ '0', '0', ],
			[ '0.', '0', ],
			[ '0', '0.', ],
			[ null, null, ],
			[ null, 0, ],
			[ 0, null, ],
			[ null, '', ],
			[ '', null, ],
			[ false, false, ],
			[ false, 0, ],
			[ 0, false, ],
			[ true, true, ],
			[ 1, true, ],
			[ true, 1, ],
			[ true, uniqid(), ],
			[ uniqid(), true, ],
			[ M_PI, M_PI, ]
		];
	}

	protected function koProvider()
	{
		return [
			[ 'bar', 'foo' ]
		];
	}
}
