<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

trait lessThan
{
	protected function okProvider()
	{
		return [
			[ PHP_INT_MIN, rand(PHP_INT_MIN + 1, PHP_INT_MAX) ],
			[ M_PI, M_PI + 1 ],
			[ 'a', 'z' ],
			[ '', uniqid() ],
			[ null, uniqid() ],
			[ false, uniqid() ],
			[ false, true ],
			[ [], [ uniqid() ] ]
		];
	}

	protected function koProvider()
	{
		return [
			[ 0, 0, ],
			[ PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, PHP_INT_MAX ],
			[ M_PI, M_PI ],
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX), PHP_INT_MIN ],
			[ 'a', 'a' ],
			[ '', '' ],
			[ 'z', 'a' ],
			[ true, false ],
			[ uniqid(), '' ],
			[ uniqid(), null ],
			[ null, null ],
			[ true, 'foo' ],
			[ true, true ],
			[ false, false ],
		];
	}
}
