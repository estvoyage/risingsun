<?php namespace estvoyage\risingsun\oboolean\recipient;

use estvoyage\risingsun\{ oboolean, block };

class functor extends block\functor
	implements
		oboolean\recipient
{
	function obooleanIs(oboolean $oboolean)
	{
		return $this->blockArgumentsAre($oboolean);
	}
}
