<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\block;

interface controller
{
	function recipientOfContainerIteratorEngineControllerWithBlockIs(block $block, controller\recipient $recipient);
	function remainingIterationsInContainerIteratorEngineAreUseless();
}
