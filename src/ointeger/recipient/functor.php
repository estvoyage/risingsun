<?php namespace estvoyage\risingsun\ointeger\recipient;

use estvoyage\risingsun\{ ointeger, block };

class functor extends block\functor
	implements
		ointeger\recipient
{
	function ointegerIs(ointeger $ointeger)
	{
		return $this->blockArgumentsAre($ointeger);
	}
}
