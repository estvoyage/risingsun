<?php namespace estvoyage\risingsun\tests\units\providers\ointeger\comparison;

trait greaterThanOrEqualTo
{
	protected function provider()
	{
		return [
			[ 0, 0, true ],
			[ $value = rand(PHP_INT_MIN, -1), $value, true ],
			[ rand(1, PHP_INT_MAX), 0, true ],
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX), PHP_INT_MIN, true ],
			[ rand(PHP_INT_MIN, -1), 0, false ]
		];
	}
}
