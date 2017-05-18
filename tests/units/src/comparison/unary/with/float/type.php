<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\float;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;

class type extends units\comparison\unary\with
{
	protected function okProvider()
	{
		return [
			0.,
			1.,
			M_PI
		];
	}

	protected function koProvider()
	{
		return [
			0,
			'0',
			rand(PHP_INT_MIN, -1),
			(string) rand(PHP_INT_MIN, -1),
			rand(1, PHP_INT_MAX),
			(string) rand(1, PHP_INT_MAX),
			false,
			true,
			'foo',
			new \stdClass,
			(string) M_PI
		];
	}
}
