<?php namespace estvoyage\risingsun\ofloat\part\integral\recipient;

use
	estvoyage\risingsun
;

class blackhole
	implements
		risingsun\ofloat\part\integral\recipient
{
	function integralPartIs(risingsun\ofloat\part\integral $part)
	{
		return $this;
	}
}
