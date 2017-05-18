<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

trait equal
{
	protected function okProvider()
	{
		return [
			[ 'foo', 'foo' ],
			[ 0, 0, ],
			[ 0., 0, ],
			[ 0, 0., ],
			[ '0', '0', ],
			[ '0.', '0', ],
			[ '0', '0.', ],
			[ null, null, ],
			[ null, 0, ],
			[ 0, null, ],
			[ null, '', ],
			[ '', null, ],
			[ false, false, ],
			[ false, 0, ],
			[ 0, false, ],
			[ true, true, ],
			[ 1, true, ],
			[ true, 1, ],
			[ true, uniqid(), ],
			[ uniqid(), true, ],
			[ M_PI, M_PI, ]
		];
	}

	protected function koProvider()
	{
		return [
			[ 'bar', 'foo' ]
		];
	}
}
