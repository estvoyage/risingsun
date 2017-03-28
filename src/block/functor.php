<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, container\iterator, ointeger, datum, container };

class functor
	implements
		block,
		datum\operation\unary\container\payload
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

	function containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(datum\operation\unary $operation, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($operation, $position, $controller);
	}
}
