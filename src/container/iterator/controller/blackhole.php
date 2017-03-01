<?php namespace estvoyage\risingsun\container\iterator\controller;

use estvoyage\risingsun\{ container\iterator\controller, container\iterator\engine };

class blackhole
	implements
		controller
{
	function containerIteratorEngineIs(engine $engine)
	{
		return $this;
	}

	function remainingIterationsAreUseless()
	{
		return $this;
	}

	function containerIteratorEngineHasNoMoreIteration()
	{
		return $this;
	}
}
