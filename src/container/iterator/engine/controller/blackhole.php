<?php namespace estvoyage\risingsun\container\iterator\engine\controller;

use estvoyage\risingsun\{ container\iterator\engine, block };

class blackhole
	implements
		engine\controller
{
	function recipientOfContainerIteratorEngineControllerWithBlockIs(block $block, engine\controller\recipient $recipient)
	{
		return $this;
	}

	function remainingIterationsInContainerIteratorEngineAreUseless()
	{
		return $this;
	}
}
