<?php namespace estvoyage\risingsun\datum\length\recipient;

use estvoyage\risingsun\{ datum, block };

class functor extends block\functor
	implements
		datum\length\recipient
{

	function datumLengthIs(datum\length $length)
	{
		return $this->blockArgumentsAre($length);
	}
}
