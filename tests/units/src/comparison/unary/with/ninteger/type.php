<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\ninteger;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\block as mockOfBlock;

class type extends units\comparison\unary\with
{
	protected function okProvider()
	{
		return [
			rand(PHP_INT_MIN, PHP_INT_MAX)
		];
	}

	protected function koProvider()
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
