<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\magic;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;

class toString extends units\comparison\unary\with
{
	protected function okProvider()
	{
		return [
			new class
			{
				function __toString()
				{
					return '';
				}
			}
		];
	}

	protected function koProvider()
	{
		return [
			new \stdClass,
			uniqid(),
			rand(PHP_INT_MIN, PHP_INT_MAX),
			M_PI,
			[ [] ],
			null,
			true,
			false
		];
	}
}
