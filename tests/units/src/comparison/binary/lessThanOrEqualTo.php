<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class lessThanOrEqualTo extends units\comparison\binary
{
	protected function okProvider()
	{
		return [
			[ 0, rand(1, PHP_INT_MAX) ],
			[ 0, 0 ],
			[ 'a', 'z' ],
			[ 'a', 'a' ],
			[ null, null ],
			[ null, rand(1, PHP_INT_MAX) ]
		];
	}

	protected function koProvider()
	{
		return [
			[ rand(1, PHP_INT_MAX), 0 ],
			[ 'z', 'a' ],
			[ rand(1, PHP_INT_MAX), null ]
		];
	}
}
