<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class greaterThanOrEqualTo extends units\comparison\binary
{
	protected function okProvider()
	{
		return [
			[ rand(1, PHP_INT_MAX), 0 ],
			[ 'z', 'a' ],
			[ 0, 0 ],
			[ 'a', 'a' ],
			[ null, null ],
			[ rand(1, PHP_INT_MAX), null ]
		];
	}

	protected function koProvider()
	{
		return [
			[ 0, rand(1, PHP_INT_MAX) ],
			[ 'a', 'z' ],
			[ null, rand(1, PHP_INT_MAX) ]
		];
	}
}
