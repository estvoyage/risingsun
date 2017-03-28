<?php namespace estvoyage\risingsun\datum\finder\recipient;

use estvoyage\risingsun\{ datum\finder, ointeger, block };

class functor extends block\functor
	implements
		finder\recipient
{
	function datumIsAtPosition(ointeger\unsigned $position)
	{
		return $this->blockArgumentsAre($position);
	}
}
