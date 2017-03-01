<?php namespace estvoyage\risingsun\container\iterator\controller;

use estvoyage\risingsun\{ container\iterator\controller, block, container\iterator\engine };

class stopper
	implements
		controller
{
	private
		$block
	;

	function __construct(engine $engine = null)
	{
		$this->engine = $engine ?: new engine\blackhole;
	}

	function containerIteratorEngineIs(engine $engine)
	{
		$controller = clone $this;
		$controller->engine = $engine;

		$controller->engine->controllerOfContainerIteratorIs($controller);

		return $this;
	}

	function containerIteratorEngineHasNoMoreIteration()
	{
		return $this;
	}

	function remainingIterationsAreUseless()
	{
		$this->engine->remainingIterationsAreUseless();

		return $this;
	}
}
