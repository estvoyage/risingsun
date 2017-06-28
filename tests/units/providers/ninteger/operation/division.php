<?php namespace estvoyage\risingsun\tests\units\providers\ninteger\operation;

trait division
{
	protected function operandsProvider()
	{
		return [
			[ 2, 1, 2 ],
			[ 1, 2, 0 ],
			[ 2, 2, 1 ],
			[ 6, 2, 3 ],
			[ 2, -1, -2 ],
			[ -2, 1, -2 ],
			[ -2, -1, 2 ],
			[ -6, 2, -3 ],
			[ -6, -2, 3 ]
		];
	}
}
