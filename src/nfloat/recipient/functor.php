<?php namespace estvoyage\risingsun\nfloat\recipient;

use estvoyage\risingsun\{ nfloat, block };

class functor extends block\functor
	implements
		nfloat\recipient
{
	function nfloatIs(float $float)
	{
		return $this->blockArgumentsAre($float);
	}
}
