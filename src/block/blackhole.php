<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\block;

class blackhole
	implements
		block
{
	function blockArgumentsAre(... $arguments)
	{
		return $this;
	}
}
