<?php namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun
;

class blackhole
	implements
		risingsun\block
{
	function blockArgumentsAre(... $arguments)
	{
		return $this;
	}
}
