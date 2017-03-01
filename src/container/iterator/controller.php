<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\block;

interface controller
{
	function blockToStopContainerIteratorEngineIs(engine $engine, block $block);
	function endOfIterations();
	function nextIterationsAreUseless();
}
