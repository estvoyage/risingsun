<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\container\iterator\{ engine, controller };

class fifo
	implements
		engine
{
	function controllerOfContainerIteratorIs(controller $controller)
	{
		return $this;
	}
}
