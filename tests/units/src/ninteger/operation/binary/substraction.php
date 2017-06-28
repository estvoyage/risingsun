<?php namespace estvoyage\risingsun\tests\units\ninteger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class substraction extends units\ninteger\operation\binary
{
	protected function operandsProvider()
	{
		return [
			[ 0, 0, 0 ],
			[ 1, 0, 1 ],
			[ 0, 1, -1 ],
			[ 0, -1, 1 ],
			[ -1, 0, -1 ],
			[ 3, 2, 1 ],
			[ 2, 3, -1 ],
			[ -1, 1, -2 ],
			[ 1, -1, 2 ],
			[ -1, -1, 0 ]
		];
	}

	protected function overflowProvider()
	{
		return [
			[ PHP_INT_MIN, 1 ]
		];
	}
}
