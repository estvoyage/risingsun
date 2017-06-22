<?php namespace estvoyage\risingsun\tests\units\providers\datum\operation;

trait padding
{
	protected function nstringProvider()
	{
		return [
			[ '', 'a', 1, 'a' ],
			[ '', 'aaaa', 8, 'aaaaaaaa' ],
			[ 'bb', 'aaaa', 8, 'bbaaaaaa' ],
			[ '', 'aaaaaaaa', 8, 'aaaaaaaa' ],
			[ '', '0', 8, '00000000' ]
		];
	}
}
