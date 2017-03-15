<?php namespace estvoyage\risingsun\datum\operation\unary\container;

use estvoyage\risingsun\{ datum\operation\unary as operation, ointeger, container\iterator\engine\controller };

interface payload
{
	function containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(operation $operation, ointeger $position, controller $controller);
}
