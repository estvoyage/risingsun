<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, nstring, oboolean, container\iterator, container\payload, ointeger, ninteger };

class functor
	implements
		block,
		nstring\recipient,
		oboolean\recipient,
		iterator\engine,
		payload,
		ointeger\recipient,
		ninteger\recipient
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
		return $this->blockArgumentsAre($nstring);
	}

	function obooleanIs(oboolean $oboolean)
	{
		return $this->blockArgumentsAre($oboolean);
	}

	function controllerOfContainerIteratorIs(iterator\controller $controller)
	{
		return $this->blockArgumentsAre($controller);
	}

	function containerIteratorControllerForValueAtPositionIs($value, ointeger $position, iterator\controller $controller)
	{
		return $this->blockArgumentsAre($value, $position, $controller);
	}

	function ointegerIs(ointeger $ointeger)
	{
		$this->blockArgumentsAre($ointeger);

		return $this;
	}

	function nintegerIs(int $ninteger)
	{
		$this->blockArgumentsAre($ninteger);

		return $this;
	}
}
