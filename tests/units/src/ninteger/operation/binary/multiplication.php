<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class multiplication extends units\ninteger\operation\binary
{
	protected function operandsProvider()
	{
		return [
			[ 0, 0, 0 ],
			[ 1, 0, 0 ],
			[ 0, 1, 0 ],
			[ 0, -1, 0 ],
			[ -1, 0, 0 ],
			[ 3, 2, 6 ],
			[ 2, 3, 6 ],
			[ -1, 1, -1 ],
			[ 1, -1, -1 ],
			[ -1, -1, 1 ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ PHP_INT_MIN, 2 ],
			[ 2, PHP_INT_MIN ],
			[ PHP_INT_MAX, 2 ],
			[ 2, PHP_INT_MAX ]
		];
	}
}
