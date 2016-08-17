<?php namespace estvoyage\risingsun\ofloat\part\decimal\recipient;

use
	estvoyage\risingsun
;

class blackhole
	implements
		risingsun\ofloat\part\decimal\recipient
{
	function decimalPartIs(risingsun\ofloat\part\decimal $part)
	{
		return $this;
	}
}
