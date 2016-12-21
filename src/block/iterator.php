<?php namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun
;

class iterator
	implements
		risingsun\block
{
	private
		$iterator,
		$collection
	;

	function __construct(risingsun\iterator $iterator, risingsun\block\collection $collection)
	{
		$this->iterator = $iterator;
		$this->collection = $collection;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->collection->payloadForIteratorIs($this->iterator, new risingsun\block\functor(function($iterator, $block) use ($arguments) { $block->blockArgumentsAre(... $arguments); }));

		return $this;
	}
}
