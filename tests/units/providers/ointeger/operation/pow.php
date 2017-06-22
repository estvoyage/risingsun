<?php namespace estvoyage\risingsun\tests\units\providers\ointeger\operation;

trait pow
{
	protected function validOperandsProvider()
	{
		return [
			[ rand(PHP_INT_MIN, PHP_INT_MAX), 0, 1 ],
			[ PHP_INT_MIN, 1, PHP_INT_MIN ],
			[ PHP_INT_MAX, 1, PHP_INT_MAX ],
			[ $value = rand(PHP_INT_MIN +1, PHP_INT_MAX -1), 1, $value ],
			[ 1, rand(2, PHP_INT_MAX), 1 ],
			[ 2, 3, 8 ],
			[ 3, 2, 9 ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ 2, PHP_INT_MAX ],
			[ PHP_INT_MAX, 2 ],
			[ PHP_INT_MAX, PHP_INT_MAX ]
		];
	}
}
