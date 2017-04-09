<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\ninteger;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class type extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	/**
	 * @dataProvider nIntegerProvider
	 */
	function testOperandForComparisonIs_withNInteger($value)
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
						->withArguments($value)
							->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider notNIntegerProvider
	 */
	function testOperandForComparisonIs_withNotNInteger($value)
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
						->withArguments($value)
							->once
		;
	}

	protected function nIntegerProvider()
	{
		return [
			rand(PHP_INT_MIN, PHP_INT_MAX)
		];
	}

	protected function notNIntegerProvider()
	{
		return [
			'',
			'foobar',
			'58abc0',
			(string) rand(PHP_INT_MIN, PHP_INT_MAX),
			null,
			true,
			false,
			[ [] ],
			M_PI,
			- M_PI,
			new \stdclass
		];
	}
}
