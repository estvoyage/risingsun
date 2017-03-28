<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, nstring, container\iterator, ointeger, ninteger, datum, comparison, container, nfloat, ofloat };

class functor
	implements
		block,
		datum\container\payload,
		comparison\recipient,
		container\iterator\engine\controller\recipient,
		container\iterator\payload,
		datum\operation\unary\container\payload,
		datum\finder\recipient,
		nfloat\recipient,
		ointeger\unsigned\recipient,
		ofloat\recipient
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

	function containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(datum\operation\unary $operation, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($operation, $position, $controller);
	}

	function datumIsAtPosition(ointeger\unsigned $position)
	{
		return $this->blockArgumentsAre($position);
	}

	function nfloatIs(float $float)
	{
		return $this->blockArgumentsAre($float);
	}

	function unsignedOIntegerIs(ointeger\unsigned $ointeger)
	{
		return $this->blockArgumentsAre($ointeger);
	}

	function ofloatIs(ofloat $ofloat)
	{
		return $this->blockArgumentsAre($ofloat);
	}
}
