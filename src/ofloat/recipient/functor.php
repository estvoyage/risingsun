<?php namespace estvoyage\risingsun\ofloat\recipient;

use estvoyage\risingsun\{ ofloat, block };

class functor extends block\functor
	implements
		ofloat\recipient
{
	function ofloatIs(ofloat $ofloat)
	{
		return $this->blockArgumentsAre($ofloat);
	}
}
