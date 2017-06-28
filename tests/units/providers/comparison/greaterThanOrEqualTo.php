<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

trait greaterThanOrEqualTo
{
	protected function okProvider()
	{
		return [
			[ 0, 0, ],
			[ PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, PHP_INT_MAX ],
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX), PHP_INT_MIN ],
			[ M_PI, M_PI, ],
			[ M_PI + 1, M_PI, ],
			[ 'z', 'a' ],
			[ 'a', 'a' ],
			[ '', '' ],
			[ uniqid(), '' ],
			[ uniqid(), null ],
			[ uniqid(), false ],
			[ uniqid(), true ],
			[ null, null ],
			[ true, false ],
			[ true, true ],
			[ false, false ],
			[ [ uniqid() ], [] ]
		];
	}

	protected function koProvider()
	{
		return [
			[ PHP_INT_MIN, rand(PHP_INT_MIN + 1, PHP_INT_MAX) ],
			[ 'a', 'z' ],
			[ false, true ],
			[ '', uniqid() ],
			[ null, uniqid() ]
		];
	}
}
