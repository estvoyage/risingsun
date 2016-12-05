<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class collection
{
	private
		$collection
	;

	function __construct(http\route... $routes)
	{
		$this->collection = new risingsun\collection(... $routes);
	}

	function payloadForIteratorIs(risingsun\iterator $iterator, risingsun\iterator\payload $payload)
	{
		$this->collection->payloadForIteratorIs($iterator, $payload);

		return $this;
	}
}
