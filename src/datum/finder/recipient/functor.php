<?php namespace estvoyage\risingsun\datum\finder\recipient;

use estvoyage\risingsun\{ datum, block, ointeger };

class functor extends block\functor
	implements
		datum\finder\recipient
{
	function datumIsAtPosition(ointeger $position)
	{
		return $this->blockArgumentsAre($position);
	}
}
