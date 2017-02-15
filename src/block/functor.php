<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, nstring };

class functor
	implements
		block,
		nstring\recipient
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

	function nstringIs(string $nstring)
	{
		$this->blockArgumentsAre($nstring);

		return $this;
	}
}
