<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not\with\numeric;

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
			->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new block\blackhole))
		;
	}

	/**
	 * @dataProvider numericProvider
	 */
	function testOperandForComparisonIs($value)
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
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}

	/**
	 * @dataProvider notNumericProvider
	 */
	function testRecipientOfComparisonWithValueIs_withNotNumeric($value)
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
		;
	}

	protected function numericProvider()
	{
		return [
			0,
			'0',
			0.,
			'0.',
			rand(- PHP_INT_MAX, PHP_INT_MAX),
			(string) rand(- PHP_INT_MAX, PHP_INT_MAX),
			M_PI,
			(string) M_PI,
			1e9,
			'1e9',
			-1e9,
			'-1e9',
			0x539,
			02471,
			'02471',
			0b10100111001
		];
	}

	protected function notNumericProvider()
	{
		return [
			'- 1e9',
			'0x539',
			'0b10100111001',
			[ [] ],
			new \stdClass
		];
	}
}
