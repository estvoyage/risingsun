<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

trait identical
{
	protected function okProvider()
	{
		return [
			[ 'foo', 'foo' ],
			[ 0, 0, ],
			[ '0', '0', ],
			[ null, null, ],
			[ false, false, ],
			[ true, true, ],
			[ M_PI, M_PI, ]
		];
	}

	protected function koProvider()
	{
		return [
			[ 0., 0, ],
			[ 0, 0., ],
			[ 'bar', 'foo' ],
			[ '0.', '0', ],
			[ '0', '0.', ],
			[ null, '', ],
			[ '', null, ],
			[ null, 0, ],
			[ 0, null, ],
			[ false, 0, ],
			[ 0, false, ],
			[ 1, true, ],
			[ true, 1, ],
			[ true, uniqid(), ],
			[ uniqid(), true, ]
		];
	}
}
