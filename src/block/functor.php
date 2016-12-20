<?php

namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun
;

class functor
	implements
		risingsun\block,
		risingsun\error\manager,
		risingsun\iterator\payload
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

	function errorIs(risingsun\error $error)
	{
		$this->blockArgumentsAre($error);

		return $this;
	}

	function currentValueOfIteratorIs(risingsun\iterator $iterator, $value)
	{
		return $this->blockArgumentsAre($iterator, $value);
	}
}
