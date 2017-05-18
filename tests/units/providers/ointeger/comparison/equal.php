<?php namespace estvoyage\risingsun\tests\units\providers\ointeger\comparison;

trait equal
{
	protected function provider()
	{
		return [
			[ 0, 0, true ],
			[ $value = rand(1, PHP_INT_MAX), $value, true ],
			[ $value = rand(PHP_INT_MIN, -1), $value, true ],
			[ 0, rand(1, PHP_INT_MAX), false ],
			[ rand(1, PHP_INT_MAX), 0, false ],
			[ rand(PHP_INT_MIN, -1), 0, false ],
			[ 0, rand(PHP_INT_MIN, -1), false ]
		];
	}
}
