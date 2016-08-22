<?php namespace estvoyage\risingsun;

class blackhole
{
	function __call($method, $arguments)
	{
		return $this;
	}
}
