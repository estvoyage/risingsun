<?php namespace estvoyage\risingsun\datum\container\payload;

use estvoyage\risingsun\{ datum, block, ointeger, container\iterator };

class functor extends block\functor
	implements
		datum\container\payload
{
	function containerIteratorEngineControllerForDatumAtPositionIs(datum $datum, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($datum, $position, $controller);
	}
}
