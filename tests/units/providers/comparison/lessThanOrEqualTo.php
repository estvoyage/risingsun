<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

trait lessThanOrEqualTo
{
	protected function okProvider()
	{
		return [
			[ 0, 0, ],
			[ PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, PHP_INT_MAX ],
			[ PHP_INT_MIN, rand(PHP_INT_MIN + 1, PHP_INT_MAX) ],
			[ M_PI, M_PI ],
			[ M_PI, M_PI + 1 ],
			[ 'a', 'z' ],
			[ 'a', 'a' ],
			[ '', '' ],
			[ '', uniqid() ],
			[ null, uniqid() ],
			[ false, uniqid() ],
			[ true, uniqid() ],
			[ null, null ],
			[ false, true ],
			[ true, true ],
			[ false, false ],
			[ [], [ uniqid() ] ]
		];
	}

	protected function koProvider()
	{
		return [
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX), PHP_INT_MIN  ],
			[ 'z', 'a' ],
			[ true, false ],
			[ uniqid(), '' ],
			[ uniqid(), null ]
		];
	}
}
