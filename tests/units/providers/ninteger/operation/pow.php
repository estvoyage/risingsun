<?php namespace estvoyage\risingsun\tests\units\providers\ninteger\operation;

trait pow
{
	protected function operandsProvider()
	{
		return [
			[ rand(PHP_INT_MIN, PHP_INT_MAX), 0, 1 ],
			[ - rand(PHP_INT_MIN, PHP_INT_MAX), 0, 1 ],
			[ $value = rand(PHP_INT_MIN, PHP_INT_MAX), 1, $value ],
			[ 2, 3, 8 ],
			[ -2, 3, -8 ],
			[ 3, 2, 9 ],
			[ -3, 2, 9 ],
			[ -3, 3, -27 ]
		];
	}

	protected function negativeExponentProvider()
	{
		return [
			[ rand(PHP_INT_MIN, PHP_INT_MAX), rand(PHP_INT_MIN, -1) ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ PHP_INT_MIN, 2 ],
			[ PHP_INT_MAX, 2 ]
		];
	}
}
