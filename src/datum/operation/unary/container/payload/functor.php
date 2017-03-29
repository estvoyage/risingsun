<?php namespace estvoyage\risingsun\datum\operation\unary\container\payload;

use estvoyage\risingsun\{ datum, block, ointeger, container\iterator };

class functor extends block\functor
	implements
		datum\operation\unary\container\payload
{
	function containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(datum\operation\unary $operation, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($operation, $position, $controller);
	}
}
