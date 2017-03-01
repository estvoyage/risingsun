<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\container\iterator;

class blackhole
	implements
		iterator\engine
{
	function controllerOfContainerIteratorIs(iterator\controller $controller)
	{
		return $this;
	}

	function nextIterationsAreUseless()
	{
		return $this;
	}

	function endOfIteration()
	{
		return $this;
	}
}
