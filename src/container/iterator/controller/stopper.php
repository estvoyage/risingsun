<?php namespace estvoyage\risingsun\container\iterator\controller;

use estvoyage\risingsun\{ container\iterator\controller, block, container\iterator\engine };

class stopper
	implements
		controller
{
	private
		$block
	;

	function __construct(block $block = null)
	{
		$this->block = $block ?: new block\blackhole;
	}

	function blockToStopContainerIteratorEngineIs(engine $engine, block $block)
	{
		$controller = clone $this;
		$controller->block = $block;

		$engine->controllerOfContainerIteratorIs($controller);

		return $this;
	}

	function nextContainerValuesAreUseless()
	{
		$this->block->blockArgumentsAre();

		return $this;
	}
}
