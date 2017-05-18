<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\true;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;

class boolean extends units\comparison\unary\with
{
	protected function okProvider()
	{
		return [
			true
		];
	}

	protected function koProvider()
	{
		return [
			0.,
			1.,
			M_PI,
			0,
			'0',
			rand(PHP_INT_MIN, -1),
			(string) rand(PHP_INT_MIN, -1),
			rand(1, PHP_INT_MAX),
			(string) rand(1, PHP_INT_MAX),
			false,
			'foo',
			new \stdClass,
			(string) M_PI
		];
	}
}
