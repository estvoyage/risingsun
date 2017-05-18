<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not\with\numeric;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class type extends units\comparison\unary\with
{
	protected function okProvider()
	{
		return [
			'- 1e9',
			'0x539',
			'0b10100111001',
			[ [] ],
			new \stdClass
		];
	}

	protected function koProvider()
	{
		return [
			0,
			'0',
			0.,
			'0.',
			rand(PHP_INT_MIN, PHP_INT_MAX),
			(string) rand(PHP_INT_MIN, PHP_INT_MAX),
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
}
