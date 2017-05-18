<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\integer;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;

class type extends units\comparison\unary\with\true\boolean
{
	protected function okProvider()
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

	protected function koProvider()
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
}
