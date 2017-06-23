<?php namespace estvoyage\risingsun\tests\units\providers\datum\operation;

trait addition
{
	protected function nstringProvider()
	{
		return [
			[ '', '', '' ],
			[ 'foo', '', 'foo' ],
			[ '', 'foo', 'foo' ],
			[ 'foo', 'foo', 'foofoo' ],
			[ 'foo', 'bar', 'foobar' ]
		];
	}
}
