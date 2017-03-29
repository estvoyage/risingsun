<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\block;

class functor
	implements
		block
{
	private
		$callable
	;

	function __construct(callable $callable)
	{
		$this->callable = $callable;
	}

	function blockArgumentsAre(... $arguments)
	{
		call_user_func_array($this->callable, $arguments);

		return $this;
	}
}
