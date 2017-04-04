<?php namespace estvoyage\risingsun\datum\finder\recipient;

use estvoyage\risingsun\{ datum, block };

class functor extends block\functor
	implements
		datum\finder\recipient
{
	function datumIsAtPosition(datum\length $position)
	{
		return $this->blockArgumentsAre($position);
	}
}
