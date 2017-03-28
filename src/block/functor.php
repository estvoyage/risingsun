<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, nstring, container\iterator, ointeger, ninteger, datum, comparison, container, nfloat, ofloat };

class functor
	implements
		block,
		datum\container\payload,
		datum\operation\unary\container\payload,
		nfloat\recipient,
		ointeger\unsigned\recipient
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

	function containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(datum\operation\unary $operation, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($operation, $position, $controller);
	}

	function nfloatIs(float $float)
	{
		return $this->blockArgumentsAre($float);
	}

	function unsignedOIntegerIs(ointeger\unsigned $ointeger)
	{
		return $this->blockArgumentsAre($ointeger);
	}
}
