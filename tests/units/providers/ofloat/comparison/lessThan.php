<?php namespace estvoyage\risingsun\tests\units\providers\ofloat\comparison;

trait lessThan
{
	protected function provider()
	{
		return [
			[ 0, 0, false ],
			[ $value = rand(PHP_INT_MIN, -1), $value, false ],
			[ rand(1, PHP_INT_MAX), 0, false ],
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX), PHP_INT_MIN, false ],
			[ rand(PHP_INT_MIN, -1), 0, true ],
			[ PHP_INT_MIN, rand(PHP_INT_MIN + 1, PHP_INT_MAX), true ],
			[ M_PI, PHP_INT_MAX, true ],
			[ M_PI, PHP_INT_MIN, false ]
		];
	}
}
