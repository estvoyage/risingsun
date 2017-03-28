<?php namespace estvoyage\risingsun\ointeger\unsigned\recipient;

use estvoyage\risingsun\{ ointeger, block };

class functor extends block\functor
	implements
		ointeger\unsigned\recipient
{
	function unsignedOIntegerIs(ointeger\unsigned $ointeger)
	{
		return $this->blockArgumentsAre($ointeger);
	}
}
