<?php namespace estvoyage\risingsun\ninteger\recipient;

use estvoyage\risingsun\{ ninteger, block };

class functor extends block\functor
	implements
		ninteger\recipient
{
	function nintegerIs(int $integer)
	{
		return $this->blockArgumentsAre($integer);
	}
}
