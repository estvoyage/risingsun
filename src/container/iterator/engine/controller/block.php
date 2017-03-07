<?php namespace estvoyage\risingsun\container\iterator\engine\controller;

use estvoyage\{ risingsun, risingsun\container\iterator\engine\controller };

class block
	implements
		controller
{
	private
		$block
	;

	function __construct(risingsun\block $block = null)
	{
		$this->block = $block ?: new risingsun\block\blackhole;
	}

	function recipientOfContainerIteratorEngineControllerWithBlockIs(risingsun\block $block, recipient $recipient)
	{
		$controller = clone $this;
		$controller->block = $block;

		$recipient->containerIteratorEngineControllerIs($controller);

		return $this;
	}

	function remainingIterationsInContainerIteratorEngineAreUseless()
	{
		$this->block->blockArgumentsAre();

		return $this;
	}
}
