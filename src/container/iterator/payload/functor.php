<?php namespace estvoyage\risingsun\container\iterator\payload;

use estvoyage\risingsun\{ container\iterator, block, ointeger };

class functor extends block\functor
	implements
		iterator\payload
{
	function containerIteratorEngineControllerOfValueAtPositionIs($value, ointeger $position, iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($value, $position, $controller);
	}
}
