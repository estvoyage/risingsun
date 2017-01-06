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

	function __construct(collection\iterator $iterator, collection $collection)
	{
		$this->iterator = $iterator;
		$this->collection = $collection;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->collection->payloadForIteratorIs($this->iterator, new collection\payload\arguments(... $arguments));

		return $this;
	}
}
