<?php namespace estvoyage\risingsun\datum\recipient;

use estvoyage\risingsun\{ datum, block };

class functor extends block\functor
	implements
		datum\recipient
{
	function datumIs(datum $datum)
	{
		return $this->blockArgumentsAre($datum);
	}
}
