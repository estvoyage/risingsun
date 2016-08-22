<?php

namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator
;

class functor
	implements
		block,
		iterator\payload
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

	function currentValueOfIteratorIs(iterator $iterator, $value)
	{
		$this->blockArgumentsAre($iterator, $value);
	}
}
