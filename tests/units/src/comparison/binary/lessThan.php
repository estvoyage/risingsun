<?php namespace estvoyage\risingsun\tests\units\comparison\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class lessThan extends units\comparison\binary
{
	protected function okProvider()
	{
		return [
			[ 0, rand(1, PHP_INT_MAX) ],
			[ 'a', 'z' ],
			[ null, rand(1, PHP_INT_MAX) ]
		];
	}

	protected function koProvider()
	{
		return [
			[ rand(1, PHP_INT_MAX), 0 ],
			[ 0, 0 ],
			[ 'a', 'a' ],
			[ 'z', 'a' ],
			[ null, null ],
			[ rand(1, PHP_INT_MAX), null ]
		];
	}
}
