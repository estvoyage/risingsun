<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not\with\integer;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class type extends units\test
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

	/**
	 * @dataProvider validValueProvider
	 */
	function testOperandForComparisonIs_withValidValue($value)
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
				->object($this->testedInstance->operandForComparisonIs($value))
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
	 * @dataProvider invalidValueProvider
	 */
	function testOperandForComparisonIs_withInvalidValue($value)
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
				->object($this->testedInstance->operandForComparisonIs($value))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}

	protected function validValueProvider()
	{
		return [
			M_PI,
			(string) M_PI,
			'',
			false,
			true,
			null,
			new \stdClass
		];
	}

	protected function invalidValueProvider()
	{
		return [
			0,
			PHP_INT_MIN,
			PHP_INT_MAX,
			'0',
			(string) PHP_INT_MIN,
			(string) PHP_INT_MAX
		];
	}
}
