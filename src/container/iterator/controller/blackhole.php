<?php namespace estvoyage\risingsun\container\iterator\controller;

use estvoyage\risingsun\{ container\iterator\controller, container\iterator\engine, block };

class blackhole
	implements
		controller
{
	function blockToStopContainerIteratorEngineIs(engine $engine, block $block)
	{
		return $this;
	}

	function nextIterationsAreUseless()
	{
		return $this;
	}

	function endOfIterations()
	{
		return $this;
	}
}
