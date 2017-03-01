<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\block;

interface controller
{
	function containerIteratorEngineIs(engine $engine);
	function containerIteratorEngineHasNoMoreIteration();
	function remainingIterationsAreUseless();
}
