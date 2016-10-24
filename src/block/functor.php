<?php

namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\error,
	estvoyage\risingsun\iterator
;

class functor
	implements
		block,
		error\manager,
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

	function errorIs(error $error)
	{
		$this->blockArgumentsAre($error);

		return $this;
	}

	function currentValueOfIteratorIs(iterator $iterator, $value)
	{
		return $this->blockArgumentsAre($iterator, $value);
	}
}
