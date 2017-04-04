<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\true;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class boolean extends units\test
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
			->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole))
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

	protected function validValueProvider()
	{
		return [
			true
		];
	}

	protected function invalidValueProvider()
	{
		return [
			0.,
			1.,
			M_PI,
			0,
			'0',
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			rand(1, PHP_INT_MAX),
			(string) rand(1, PHP_INT_MAX),
			false,
			'foo',
			new \stdClass,
			(string) M_PI
		];
	}
}
