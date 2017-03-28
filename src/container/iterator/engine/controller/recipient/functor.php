<?php namespace estvoyage\risingsun\container\iterator\engine\controller\recipient;

use estvoyage\risingsun\{ container\iterator, container\iterator\engine\controller, block };

class functor extends block\functor
	implements
		controller\recipient
{
	function containerIteratorEngineControllerIs(iterator\engine\controller $controller)
	{
		return $this->blockArgumentsAre($controller);
	}
}
