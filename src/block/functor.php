<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, nstring, oboolean, container\iterator, ointeger, ninteger, datum, comparison, container };

class functor
	implements
		block,
		nstring\recipient,
		oboolean\recipient,
		ointeger\recipient,
		ninteger\recipient,
		datum\recipient,
		datum\container\payload,
		comparison\recipient,
		container\iterator\engine\controller\recipient,
		container\iterator\payload
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

	function ointegerIs(ointeger $ointeger)
	{
		return $this->blockArgumentsAre($ointeger);
	}

	function nintegerIs(int $ninteger)
	{
		return $this->blockArgumentsAre($ninteger);
	}

	function datumIs(datum $datum)
	{
		return $this->blockArgumentsAre($datum);
	}

	function containerIteratorEngineControllerForDatumAtPositionIs(datum $datum, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($datum, $position, $controller);
	}

	function comparisonIsTrue()
	{
		return $this->blockArgumentsAre();
	}

	function comparisonIsFalse()
	{
		return $this;
	}

	function containerIteratorEngineControllerIs(iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($controller);
	}

	function containerIteratorEngineControllerOfValueAtPositionIs($value, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($value, $position, $controller);
	}
}
