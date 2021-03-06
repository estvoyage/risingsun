<?php namespace estvoyage\risingsun\tests\units\providers\ninteger\operation;

trait addition
{
	protected function operandsProvider()
	{
		return [
			[ 0, 0, 0 ],
			[ 1, 0, 1 ],
			[ 0, 1, 1 ],
			[ 0, -1, -1 ],
			[ -1, 0, -1 ],
			[ 3, 2, 5 ],
			[ 2, 3, 5 ],
			[ -1, 1, 0 ],
			[ 1, -1, 0 ],
			[ -1, -1, -2 ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ PHP_INT_MIN, -1 ],
			[ PHP_INT_MAX, 1 ]
		];
	}
}
