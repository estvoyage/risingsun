<?php namespace estvoyage\risingsun\ostring\recipient\block;

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\ostring
;

class functor extends block\functor
	implements
		ostring\recipient
{
	function ostringIs(ostring $string)
	{
		return $this->blockArgumentsAre($string);
	}
}
