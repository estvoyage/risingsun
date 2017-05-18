<?php namespace estvoyage\risingsun\tests\units\comparison\unary\not\with\integer;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\block as mockOfBlock;

class type extends units\comparison\unary\with
{
	protected function okProvider()
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

	protected function koProvider()
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
